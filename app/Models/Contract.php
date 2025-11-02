<?php

namespace App\Models;

use App\Enums\ContractStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracker_project_id',
        'project_id',
        'client_id',
        'freelancer_id',
        'type',
        'status',
        'hourly_rate',
        'weekly_limit_hours',
        'allow_manual_time',
        'auto_approve_low_activity',
        'currency_code',
        'timezone',
        'starts_at',
        'ends_at',
        'archived_at',
        'created_by',
        'updated_by',
        'notes',
    ];

    protected $casts = [
        'status'                   => ContractStatus::class,
        'hourly_rate'              => 'decimal:2',
        'weekly_limit_hours'       => 'decimal:2',
        'allow_manual_time'        => 'boolean',
        'auto_approve_low_activity'=> 'boolean',
        'starts_at'                => 'datetime',
        'ends_at'                  => 'datetime',
        'archived_at'              => 'datetime',
    ];

    public function trackerProject()
    {
        return $this->belongsTo(TrackerProject::class, 'tracker_project_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function time_entries()
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', ContractStatus::Active);
    }
}
