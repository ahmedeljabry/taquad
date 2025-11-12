<?php

namespace App\Livewire\Main\Account\Projects;

use App\Actions\Hourly\SendOfferAction;
use App\Enums\ProposalStatus;
use App\Models\Project;
use App\Models\Proposal;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

class ManageProposalsComponent extends Component
{
    use SEOToolsTrait, LivewireAlert, WithPagination;

    #[Locked]
    public string $projectUid;

    public ?Project $project = null;
    
    public ?int $selectedProposalId = null;
    public ?float $offerRate = null;
    public ?float $offerWeeklyLimit = 40;
    public bool $offerAllowManual = false;
    public bool $offerAutoApprove = true;
    public ?string $offerMessage = null;

    public string $statusFilter = 'all';

    public function mount(string $uid): void
    {
        $this->projectUid = $uid;

        $this->project = Project::query()
            ->where('uid', $uid)
            ->where('user_id', Auth::id())
            ->where('budget_type', 'hourly')
            ->firstOrFail();

        $this->prepareSeo();
    }

    public function render()
    {
        $proposals = Proposal::query()
            ->where('project_id', $this->project->id)
            ->with(['freelancer', 'freelancer.level'])
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest()
            ->paginate(12);

        return view('livewire.main.account.projects.manage-proposals', [
            'proposals' => $proposals,
        ]);
    }

    public function openOfferModal(int $proposalId): void
    {
        $proposal = Proposal::query()
            ->where('id', $proposalId)
            ->where('project_id', $this->project->id)
            ->firstOrFail();

        $this->selectedProposalId = $proposalId;
        $this->offerRate = (float) $proposal->hourly_rate;
        $this->offerWeeklyLimit = 40;
        $this->offerAllowManual = false;
        $this->offerAutoApprove = true;
        $this->offerMessage = null;

        $this->dispatch('open-offer-modal');
    }

    public function sendOffer(): void
    {
        $this->validate([
            'offerRate' => ['required', 'numeric', 'min:1'],
            'offerWeeklyLimit' => ['required', 'numeric', 'min:1', 'max:168'],
            'offerMessage' => ['nullable', 'string', 'max:1000'],
        ]);

        $proposal = Proposal::query()
            ->where('id', $this->selectedProposalId)
            ->where('project_id', $this->project->id)
            ->with('freelancer')
            ->firstOrFail();

        $sendOfferAction = app(SendOfferAction::class);
        
        $sendOfferAction->handle($this->project, $proposal->freelancer, [
            'hourly_rate' => $this->offerRate,
            'weekly_limit_hours' => $this->offerWeeklyLimit,
            'allow_manual_time' => $this->offerAllowManual,
            'auto_approve_low_activity' => $this->offerAutoApprove,
            'message' => $this->offerMessage,
            'proposal_id' => $proposal->id,
        ]);

        $this->alert('success', __('messages.t_success'), [
            'text' => __('messages.t_offer_sent_successfully'),
        ]);

        $this->dispatch('close-offer-modal');
        $this->selectedProposalId = null;
        $this->reset(['offerRate', 'offerWeeklyLimit', 'offerAllowManual', 'offerAutoApprove', 'offerMessage']);
    }

    public function shortlistProposal(int $proposalId): void
    {
        $proposal = Proposal::query()
            ->where('id', $proposalId)
            ->where('project_id', $this->project->id)
            ->firstOrFail();

        $proposal->update(['status' => ProposalStatus::Shortlisted]);

        $this->alert('success', __('messages.t_success'), [
            'text' => __('messages.t_proposal_shortlisted'),
        ]);
    }

    public function rejectProposal(int $proposalId): void
    {
        $proposal = Proposal::query()
            ->where('id', $proposalId)
            ->where('project_id', $this->project->id)
            ->firstOrFail();

        $proposal->update(['status' => ProposalStatus::Rejected]);

        $this->alert('success', __('messages.t_success'), [
            'text' => __('messages.t_proposal_rejected'),
        ]);
    }

    protected function prepareSeo(): void
    {
        $title = __('messages.t_manage_proposals') . ' - ' . $this->project->title;
        $description = __('messages.t_review_proposals_for_project');

        $this->seotools()->setTitle($title);
        $this->seotools()->setDescription($description);
        $this->seotools()->opengraph()->setTitle($title);
        $this->seotools()->opengraph()->setDescription($description);
        $this->seotools()->twitter()->setTitle($title);
        $this->seotools()->twitter()->setDescription($description);
    }
}

