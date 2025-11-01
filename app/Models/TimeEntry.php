<?php

namespace App\Models;

use App\Enums\TimeEntryClientStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'user_id',
        'started_at',
        'ended_at',
        'duration_minutes',
        'memo',
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
        'synced_at',
    ];

    protected $casts = [
        'started_at'            => 'datetime',
        'ended_at'              => 'datetime',
        'client_reviewed_at'    => 'datetime',
        'synced_at'             => 'datetime',
        'low_activity'          => 'boolean',
        'is_manual'             => 'boolean',
        'has_screenshot'        => 'boolean',
        'created_from_tracker'  => 'boolean',
        'client_status'         => TimeEntryClientStatus::class,
    ];

    protected $attributes = [
        'client_status'        => TimeEntryClientStatus::Pending->value,
        'low_activity'         => false,
        'is_manual'            => false,
        'has_screenshot'       => false,
        'created_from_tracker' => false,
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
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
}
