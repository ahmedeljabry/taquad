<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDecision extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'requested_by_id',
        'responded_by_id',
        'requested_by_role',
        'type',
        'status',
        'message',
        'response_message',
        'responded_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by_id');
    }

    public function responder()
    {
        return $this->belongsTo(User::class, 'responded_by_id');
    }
}
