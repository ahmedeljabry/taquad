<?php

namespace App\Livewire\Main\Seller\Projects;

use App\Enums\ContractStatus;
use App\Enums\TimeEntryClientStatus;
use App\Models\Contract;
use App\Models\Project;
use App\Models\TimeEntry;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use WireUi\Traits\Actions;

class TrackerComponent extends Component
{
    use Actions;
    use SEOToolsTrait;

    public Project $project;
    public Contract $contract;

    public array $metrics = [];
    public array $recentEntries = [];

    public function mount(string $id)
    {
        $userId = Auth::id();

        $this->project = Project::query()
            ->with(['trackerProject', 'awarded_bid'])
            ->where('uid', $id)
            ->whereHas('bids', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->firstOrFail();

        if ($this->project->budget_type !== 'hourly') {
            $this->notification([
                'title'       => __('messages.t_notice'),
                'description' => __('messages.t_hourly_projects_notice'),
                'icon'        => 'info',
            ]);

            return redirect()->to('seller/projects/milestones/' . $this->project->uid);
        }

        $this->contract = Contract::query()
            ->where('project_id', $this->project->id)
            ->where('freelancer_id', $userId)
            ->whereIn('status', [ContractStatus::OfferSent, ContractStatus::Active, ContractStatus::Paused])
            ->with('trackerProject')
            ->latest()
            ->firstOrFail();

        $this->hydrateMetrics();
        $this->prepareSeo();
    }

    #[Layout('components.layouts.seller-app')]
    public function render()
    {
        return view('livewire.main.seller.projects.tracker');
    }

    public function refreshStats(): void
    {
        $this->hydrateMetrics();

        $this->notification([
            'title'       => __('messages.t_success'),
            'description' => __('messages.t_tracker_entries_refreshed'),
            'icon'        => 'success',
        ]);
    }

    public function formatMinutes(int $minutes): string
    {
        $hours = intdiv($minutes, 60);
        $remaining = $minutes % 60;

        if ($hours > 0) {
            return trim(sprintf('%d %s %d %s', $hours, __('messages.t_hours_short'), $remaining, __('messages.t_minutes_short')));
        }

        return sprintf('%d %s', $remaining, __('messages.t_minutes_short'));
    }

    protected function hydrateMetrics(): void
    {
        $contractId = $this->contract->id;

        $todayMinutes = TimeEntry::query()
            ->where('contract_id', $contractId)
            ->whereDate('started_at', Carbon::today())
            ->sum('duration_minutes');

        $weekMinutes = TimeEntry::query()
            ->where('contract_id', $contractId)
            ->whereBetween('started_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('duration_minutes');

        $pending = TimeEntry::query()
            ->where('contract_id', $contractId)
            ->where('client_status', TimeEntryClientStatus::Pending->value)
            ->count();

        $lastSynced = TimeEntry::query()
            ->where('contract_id', $contractId)
            ->max('synced_at');

        $this->metrics = [
            'today_minutes' => (int) $todayMinutes,
            'week_minutes'  => (int) $weekMinutes,
            'pending_count' => (int) $pending,
            'last_synced'   => $lastSynced ? Carbon::parse($lastSynced) : null,
        ];

        $this->recentEntries = TimeEntry::query()
            ->where('contract_id', $contractId)
            ->with(['snapshots' => function ($query) {
                $query->orderBy('captured_at');
            }])
            ->orderByDesc('started_at')
            ->limit(10)
            ->get([
                'id',
                'started_at',
                'ended_at',
                'duration_minutes',
                'activity_score',
                'client_status',
                'low_activity',
                'memo',
                'note',
                'has_screenshot',
                'is_manual',
            ])
            ->map(function (TimeEntry $entry) {
                $snapshots = $entry->snapshots->map(function ($snapshot) {
                    return [
                        'id' => $snapshot->id,
                        'url' => \Storage::disk($snapshot->disk)->url($snapshot->image_path),
                        'captured_at' => $snapshot->captured_at,
                    ];
                })->toArray();

                return [
                    'id'            => $entry->id,
                    'started_at'    => $entry->started_at,
                    'ended_at'      => $entry->ended_at,
                    'duration'      => (int) $entry->duration_minutes,
                    'activity'      => (int) $entry->activity_score,
                    'status'        => $entry->client_status?->value ?? $entry->client_status,
                    'low_activity'  => (bool) $entry->low_activity,
                    'memo'          => $entry->memo,
                    'note'          => $entry->note,
                    'has_screenshot'=> (bool) $entry->has_screenshot,
                    'is_manual'     => (bool) $entry->is_manual,
                    'snapshots'     => $snapshots,
                ];
            })
            ->all();
    }

    protected function prepareSeo(): void
    {
        $title = __('messages.t_tracker_hourly_hub_title');
        $description = __('messages.t_tracker_hourly_hub_description', [
            'project' => $this->project->title,
        ]);

        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $this->seo()->setCanonical(url()->current());
        $this->seo()->opengraph()->setTitle($title);
        $this->seo()->opengraph()->setDescription($description);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->setType('website');
    }
}
