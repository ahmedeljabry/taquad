<?php

namespace App\Services\Hourly;

use App\Enums\TimeEntryBillingStatus;
use App\Enums\TimeEntryClientStatus;
use App\Enums\TimeEntryLifecycleStatus;
use App\Events\Hourly\DomainEvent;
use App\Models\TimeEntry;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SegmentReviewService
{
    public function closePreviousWeek(CarbonImmutable $now): Collection
    {
        $weekStart = $this->resolvePreviousWeekStart($now);
        $weekEnd   = $weekStart->addWeek();

        return DB::transaction(function () use ($weekStart, $weekEnd) {
            $segments = TimeEntry::query()
                ->with(['contract'])
                ->whereBetween('started_at', [$weekStart, $weekEnd])
                ->where('status', TimeEntryLifecycleStatus::InProgress->value)
                ->lockForUpdate()
                ->get();

            $segments->each(fn (TimeEntry $segment) => $segment->transitionTo(TimeEntryLifecycleStatus::InReview));

            $segments->each(fn (TimeEntry $segment) => $this->dispatchEvent('week.closed', $segment, [
                'week_start'    => $weekStart->toDateString(),
                'segment_id'    => $segment->getKey(),
                'contract_id'   => $segment->contract_id,
                'freelancer_id' => $segment->user_id,
            ]));

            return $segments;
        });
    }

    public function lockPreviousWeek(CarbonImmutable $now): int
    {
        $weekStart = $this->resolvePreviousWeekStart($now);
        $weekEnd   = $weekStart->addWeek();

        return DB::transaction(function () use ($weekStart, $weekEnd) {
            $segments = TimeEntry::query()
                ->with(['contract'])
                ->whereBetween('started_at', [$weekStart, $weekEnd])
                ->where('status', TimeEntryLifecycleStatus::InReview->value)
                ->lockForUpdate()
                ->get();

            $segments->each(function (TimeEntry $segment) {
                $segment->transitionTo(TimeEntryLifecycleStatus::Locked);

                $this->dispatchEvent('review.locked', $segment, [
                    'segment_id' => $segment->getKey(),
                    'locked_at'  => optional($segment->review_locked_at)->toIso8601String(),
                ]);
            });

            return $segments->count();
        });
    }

    public function autoApprove(CarbonImmutable $now): int
    {
        $weekStart = $this->resolvePreviousWeekStart($now);
        $weekEnd   = $weekStart->addWeek();

        return DB::transaction(function () use ($weekStart, $weekEnd) {
            $segments = TimeEntry::query()
                ->with(['contract'])
                ->whereBetween('started_at', [$weekStart, $weekEnd])
                ->where('status', TimeEntryLifecycleStatus::InReview->value)
                ->lockForUpdate()
                ->get();

            $segments->each(function (TimeEntry $segment) {
                $segment->transitionTo(TimeEntryLifecycleStatus::Approved);
                $segment->markBillingStatus(TimeEntryBillingStatus::Hold);

                $this->dispatchEvent('segment.auto_approved', $segment, [
                    'segment_id' => $segment->getKey(),
                ]);
            });

            return $segments->count();
        });
    }

    public function approve(TimeEntry $segment, int $reviewerId, ?string $notes = null): TimeEntry
    {
        return DB::transaction(function () use ($segment, $reviewerId, $notes) {
            $segment->forceFill([
                'client_status'      => TimeEntryClientStatus::Approved,
                'client_reviewed_at' => now(),
                'client_reviewer_id' => $reviewerId,
                'client_notes'       => $notes,
            ])->save();

            $segment->transitionTo(TimeEntryLifecycleStatus::Approved);
            $segment->markBillingStatus(TimeEntryBillingStatus::Hold);

            $this->dispatchEvent('segment.approved', $segment, [
                'segment_id' => $segment->getKey(),
                'notes'      => $notes,
            ]);

            return $segment;
        });
    }

    public function reject(TimeEntry $segment, int $reviewerId, string $reason): TimeEntry
    {
        return DB::transaction(function () use ($segment, $reviewerId, $reason) {
            $segment->forceFill([
                'client_status'      => TimeEntryClientStatus::Rejected,
                'client_reviewed_at' => now(),
                'client_reviewer_id' => $reviewerId,
                'client_notes'       => $reason,
            ])->save();

            $segment->transitionTo(TimeEntryLifecycleStatus::Rejected);

            $this->dispatchEvent('segment.rejected', $segment, [
                'segment_id' => $segment->getKey(),
                'reason'     => $reason,
            ]);

            return $segment;
        });
    }

    protected function resolvePreviousWeekStart(CarbonImmutable $now): CarbonImmutable
    {
        return $now->setTimezone('UTC')->startOfWeek(CarbonImmutable::MONDAY)->subWeek();
    }

    protected function dispatchEvent(string $event, TimeEntry $segment, array $payload = []): void
    {
        $segment->loadMissing(['contract', 'contract.client', 'contract.freelancer']);

        $recipients = collect([
            optional($segment->contract)->client_id,
            optional($segment->contract)->freelancer_id,
        ])->filter()->unique()->values()->all();

        event(new DomainEvent(
            $event,
            array_merge([
                'time_entry_id' => $segment->getKey(),
                'status'        => $segment->status->value,
            ], $payload),
            $recipients,
            $segment->contract_id
        ));
    }
}
