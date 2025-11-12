<?php

namespace App\Livewire\Main\Seller\Contracts;

use App\Actions\Hourly\DeclineOfferAction;
use App\Actions\Hourly\AcceptProposalAction;
use App\Enums\ContractStatus;
use App\Models\Contract;
use App\Models\Proposal;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ContractsComponent extends Component
{
    use SEOToolsTrait, LivewireAlert, WithPagination;

    public string $activeTab = 'active';
    public ?int $selectedOfferId = null;
    public ?string $declineReason = null;

    public function mount(): void
    {
        $this->prepareSeo();
    }

    public function render()
    {
        $query = Contract::query()
            ->where('freelancer_id', Auth::id())
            ->with(['project', 'client', 'trackerProject']);

        switch ($this->activeTab) {
            case 'offers':
                $query->where('status', ContractStatus::OfferSent);
                break;
            case 'active':
                $query->where('status', ContractStatus::Active);
                break;
            case 'paused':
                $query->where('status', ContractStatus::Paused);
                break;
            case 'ended':
                $query->where('status', ContractStatus::Ended);
                break;
        }

        $contracts = $query->latest()->paginate(10);

        // Get earnings summary
        $activeContracts = Contract::query()
            ->where('freelancer_id', Auth::id())
            ->where('status', ContractStatus::Active)
            ->count();

        $pendingOffers = Contract::query()
            ->where('freelancer_id', Auth::id())
            ->where('status', ContractStatus::OfferSent)
            ->count();

        return view('livewire.main.seller.contracts.contracts', [
            'contracts' => $contracts,
            'activeContracts' => $activeContracts,
            'pendingOffers' => $pendingOffers,
        ]);
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function acceptOffer(int $contractId): void
    {
        $contract = Contract::query()
            ->where('id', $contractId)
            ->where('freelancer_id', Auth::id())
            ->where('status', ContractStatus::OfferSent)
            ->with('project')
            ->firstOrFail();

        // Find the associated proposal (if any)
        $proposal = Proposal::query()
            ->where('project_id', $contract->project_id)
            ->where('freelancer_id', Auth::id())
            ->first();

        if ($proposal) {
            $acceptAction = app(AcceptProposalAction::class);
            // We need to use ProjectBid model, but for now just activate the contract
            $contract->update([
                'status' => ContractStatus::Active,
                'starts_at' => now(),
                'updated_by' => Auth::id(),
            ]);
        } else {
            $contract->update([
                'status' => ContractStatus::Active,
                'starts_at' => now(),
                'updated_by' => Auth::id(),
            ]);
        }

        $this->alert('success', __('messages.t_success'), [
            'text' => __('messages.t_offer_accepted_successfully'),
        ]);
    }

    public function openDeclineModal(int $contractId): void
    {
        $this->selectedOfferId = $contractId;
        $this->declineReason = null;
        $this->dispatch('open-decline-modal');
    }

    public function declineOffer(): void
    {
        $this->validate([
            'declineReason' => ['nullable', 'string', 'max:500'],
        ]);

        $contract = Contract::query()
            ->where('id', $this->selectedOfferId)
            ->where('freelancer_id', Auth::id())
            ->where('status', ContractStatus::OfferSent)
            ->firstOrFail();

        $declineAction = app(DeclineOfferAction::class);
        $declineAction->handle($contract, Auth::id(), $this->declineReason);

        $this->alert('success', __('messages.t_success'), [
            'text' => __('messages.t_offer_declined_successfully'),
        ]);

        $this->dispatch('close-decline-modal');
        $this->reset(['selectedOfferId', 'declineReason']);
    }

    protected function prepareSeo(): void
    {
        $title = __('messages.t_my_contracts');
        $description = __('messages.t_manage_your_contracts_and_offers');

        $this->seotools()->setTitle($title);
        $this->seotools()->setDescription($description);
        $this->seotools()->opengraph()->setTitle($title);
        $this->seotools()->opengraph()->setDescription($description);
        $this->seotools()->twitter()->setTitle($title);
        $this->seotools()->twitter()->setDescription($description);
    }
}

