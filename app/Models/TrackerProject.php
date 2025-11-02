<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackerProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracker_client_id',
        'project_id',
        'created_by',
        'name',
        'reference_code',
        'description',
        'default_hourly_rate',
        'weekly_limit_hours',
        'allow_manual_time_default',
        'auto_approve_low_activity_default',
        'is_active',
        'starts_at',
        'ends_at',
        'archived_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'archived_at' => 'datetime',
        'is_active' => 'boolean',
        'default_hourly_rate' => 'decimal:2',
        'weekly_limit_hours' => 'decimal:2',
        'allow_manual_time_default' => 'boolean',
        'auto_approve_low_activity_default' => 'boolean',
    ];

    public function client()
    {
        return $this->belongsTo(TrackerClient::class, 'tracker_client_id');
    }

    public function sourceProject()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->hasMany(TrackerProjectMember::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'tracker_project_id');
    }
}
