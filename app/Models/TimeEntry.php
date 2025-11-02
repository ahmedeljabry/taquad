<?php

namespace App\Models;

use App\Enums\TimeEntryBillingStatus;
use App\Enums\TimeEntryClientStatus;
use App\Enums\TimeEntryLifecycleStatus;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use InvalidArgumentException;

class TimeEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'invoice_id',
        'user_id',
        'started_at',
        'ended_at',
        'duration_minutes',
        'activity_seconds',
        'memo',
        'note',
        'activity_score',
        'low_activity',
        'is_manual',
        'has_screenshot',
        'created_from_tracker',
        'signature',
        'client_status',
        'client_reviewed_at',
        'client_reviewer_id',
        'client_notes',
        'review_locked_at',
        'payout_available_at',
        'synced_at',
        'status',
        'billing_status',
    ];

    protected $casts = [
        'started_at'            => 'datetime',
        'ended_at'              => 'datetime',
        'client_reviewed_at'    => 'datetime',
        'review_locked_at'      => 'datetime',
        'payout_available_at'   => 'datetime',
        'synced_at'             => 'datetime',
        'low_activity'          => 'boolean',
        'is_manual'             => 'boolean',
        'has_screenshot'        => 'boolean',
        'created_from_tracker'  => 'boolean',
        'client_status'         => TimeEntryClientStatus::class,
        'status'                => TimeEntryLifecycleStatus::class,
        'billing_status'        => TimeEntryBillingStatus::class,
        'activity_seconds'      => 'integer',
    ];

    protected $attributes = [
        'client_status'        => TimeEntryClientStatus::Pending->value,
        'status'               => TimeEntryLifecycleStatus::InProgress->value,
        'billing_status'       => TimeEntryBillingStatus::Draft->value,
        'low_activity'         => false,
        'is_manual'            => false,
        'has_screenshot'       => false,
        'created_from_tracker' => false,
    ];

    protected $appends = [
        'is_locked',
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function snapshots()
    {
        return $this->hasMany(TimeSnapshot::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clientReviewer()
    {
        return $this->belongsTo(User::class, 'client_reviewer_id');
    }

    public function scopeLifecycle(Builder $query, TimeEntryLifecycleStatus $status): Builder
    {
        return $query->where('status', $status->value);
    }

    public function scopeForWindow(Builder $query, CarbonInterface $start, CarbonInterface $end): Builder
    {
        return $query->whereBetween('started_at', [$start, $end]);
    }

    public function transitionTo(TimeEntryLifecycleStatus $status): void
    {
        if ($status === $this->status) {
            return;
        }

        if (! in_array($status, $this->allowedTransitions(), true)) {
            throw new InvalidArgumentException(sprintf(
                'Cannot transition time entry %d from %s to %s',
                $this->getKey(),
                $this->status->value,
                $status->value
            ));
        }

        $this->status = $status;

        if ($status === TimeEntryLifecycleStatus::Approved) {
            $this->client_status = TimeEntryClientStatus::Approved;
            $this->review_locked_at ??= now();
        } elseif ($status === TimeEntryLifecycleStatus::Rejected) {
            $this->client_status = TimeEntryClientStatus::Rejected;
            $this->review_locked_at ??= now();
        } elseif ($status === TimeEntryLifecycleStatus::Pending) {
            $this->billing_status = TimeEntryBillingStatus::Hold;
        } elseif ($status === TimeEntryLifecycleStatus::Available) {
            $this->billing_status = TimeEntryBillingStatus::Available;
        } elseif ($status === TimeEntryLifecycleStatus::Locked) {
            $this->review_locked_at ??= now();
        }

        $this->save();
    }

    public function markBillingStatus(TimeEntryBillingStatus $status, ?CarbonInterface $availableAt = null): void
    {
        if ($status === $this->billing_status) {
            return;
        }

        $this->billing_status = $status;

        if ($status === TimeEntryBillingStatus::Available && $availableAt) {
            $this->payout_available_at = $availableAt;
        }

        $this->save();
    }

    public function getIsLockedAttribute(): bool
    {
        return $this->status === TimeEntryLifecycleStatus::Locked;
    }

    public function isEditable(): bool
    {
        return $this->status === TimeEntryLifecycleStatus::InProgress;
    }

    protected function allowedTransitions(): array
    {
        return match ($this->status) {
            TimeEntryLifecycleStatus::InProgress => [
                TimeEntryLifecycleStatus::InReview,
                TimeEntryLifecycleStatus::Locked,
            ],
            TimeEntryLifecycleStatus::InReview => [
                TimeEntryLifecycleStatus::Approved,
                TimeEntryLifecycleStatus::Rejected,
                TimeEntryLifecycleStatus::Locked,
            ],
            TimeEntryLifecycleStatus::Approved => [
                TimeEntryLifecycleStatus::Pending,
                TimeEntryLifecycleStatus::Locked,
            ],
            TimeEntryLifecycleStatus::Rejected => [
                TimeEntryLifecycleStatus::Locked,
            ],
            TimeEntryLifecycleStatus::Pending => [
                TimeEntryLifecycleStatus::Available,
                TimeEntryLifecycleStatus::Locked,
            ],
            TimeEntryLifecycleStatus::Available => [
                TimeEntryLifecycleStatus::Locked,
            ],
            TimeEntryLifecycleStatus::Locked => [],
        };
    }
}
