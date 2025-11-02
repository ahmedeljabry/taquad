<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackerProjectMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracker_project_id',
        'user_id',
        'role',
        'hourly_rate',
        'weekly_limit_hours',
        'status',
        'invited_at',
        'joined_at',
        'added_by',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'weekly_limit_hours' => 'decimal:2',
        'invited_at' => 'datetime',
        'joined_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(TrackerProject::class, 'tracker_project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adder()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}

