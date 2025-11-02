<?php

namespace App\Livewire\Main\Account\Projects\Options;

use App\Enums\TimeEntryClientStatus;
use App\Models\Contract;
use App\Models\Project;
use App\Models\TimeEntry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TrackerComponent extends Component
{
    use LivewireAlert;
    use SEOToolsTrait;

    public Project $project;
    public Contract $contract;

    public string $statusFilter = 'pending';
    public array $summary = [];
    public Collection $entries;

    public ?int $rejectEntryId = null;
    public string $rejectNotes = '';

    public function mount(string $id): void
    {
        $this->project = Project::query()
            ->with(['awarded_bid'])
            ->where('uid', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $freelancerId = optional($this->project->awarded_bid)->user_id ?? $this->project->awarded_freelancer_id;

        $this->contract = Contract::query()
            ->where('project_id', $this->project->id)
            ->when($freelancerId, fn ($query) => $query->where('freelancer_id', $freelancerId))
            ->firstOrFail();

        $this->loadEntries();
        $this->refreshSummary();
    }

    #[Layout('components.layouts.main-app')]
    public function render()
    {
        $this->seo()->setTitle(__('messages.t_tracker_activity_review'));
        $this->seo()->setDescription(__('messages.t_tracker_activity_review_subtitle', [
                'project' => $this->project->title,
            ]));

        return view('livewire.main.account.projects.options.tracker', [
            'entries' => $this->entries,
            'freelancer' => $this->contract->freelancer,
        ]);
    }

    public function updatedStatusFilter(): void
    {
        $this->loadEntries();
    }

    public function approveEntry(int $entryId): void
    {
        $entry = $this->locateEntry($entryId);

        $entry->forceFill([
            'client_status'      => TimeEntryClientStatus::Approved,
            'client_reviewed_at' => now(),
            'client_reviewer_id' => Auth::id(),
            'client_notes'       => null,
        ])->save();

        $this->rejectEntryId = null;
        $this->rejectNotes   = '';

        $this->loadEntries();
        $this->refreshSummary();

        $this->alert('success', __('messages.t_success'), [
            'text' => __('messages.t_time_entry_marked_approved'),
        ]);
    }

    public function startReject(int $entryId): void
    {
        $this->locateEntry($entryId);
        $this->rejectEntryId = $entryId;
        $this->rejectNotes   = '';
    }

    public function cancelReject(): void
    {
        $this->rejectEntryId = null;
        $this->rejectNotes   = '';
    }

    public function rejectEntry(): void
    {
        if (! $this->rejectEntryId) {
            return;
        }

        $this->validate([
            'rejectNotes' => ['required', 'string', 'min:10', 'max:500'],
        ]);

        $entry = $this->locateEntry($this->rejectEntryId);

        $entry->forceFill([
            'client_status'      => TimeEntryClientStatus::Rejected,
            'client_reviewed_at' => now(),
            'client_reviewer_id' => Auth::id(),
            'client_notes'       => $this->rejectNotes,
        ])->save();

        $this->rejectEntryId = null;
        $this->rejectNotes   = '';

        $this->loadEntries();
        $this->refreshSummary();

        $this->alert('warning', __('messages.t_notice'), [
            'text' => __('messages.t_time_entry_marked_rejected'),
        ]);
    }

    public function refreshEntries(): void
    {
        $this->loadEntries();
        $this->refreshSummary();
    }

    protected function loadEntries(): void
    {
        $query = TimeEntry::query()
            ->with(['snapshots'])
            ->where('contract_id', $this->contract->id)
            ->orderByDesc('started_at');

        if ($this->statusFilter !== 'all') {
            $query->where('client_status', $this->statusFilter);
        }

        $this->entries = $query->get();
    }

    protected function refreshSummary(): void
    {
        $grouped = TimeEntry::selectRaw('client_status, COUNT(*) as total, SUM(duration_minutes) as minutes')
            ->where('contract_id', $this->contract->id)
            ->groupBy('client_status')
            ->get()
            ->mapWithKeys(function ($row) {
                $status = $row->client_status;
                if ($status instanceof TimeEntryClientStatus) {
                    $status = $status->value;
                }

                return [$status => [
                    'count'   => (int) $row->total,
                    'minutes' => (int) $row->minutes,
                ]];
            });

        $this->summary = [
            'pending'  => $grouped['pending']['count'] ?? 0,
            'approved' => $grouped['approved']['count'] ?? 0,
            'rejected' => $grouped['rejected']['count'] ?? 0,
            'total_minutes' => $grouped->sum(fn ($item) => $item['minutes']),
        ];
    }

    protected function locateEntry(int $entryId): TimeEntry
    {
        $entry = TimeEntry::query()
            ->where('id', $entryId)
            ->where('contract_id', $this->contract->id)
            ->first();

        if (! $entry) {
            throw ValidationException::withMessages([
                'entry' => __('messages.t_time_entry_not_found_for_contract'),
            ]);
        }

        return $entry;
    }
}
