<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'project_id',
        'milestone_id',
        'reviewer_id',
        'reviewee_id',
        'reviewer_role',
        'score',
        'comment',
        'is_skipped',
        'submitted_at',
    ];

    protected $casts = [
        'is_skipped'   => 'boolean',
        'submitted_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function milestone()
    {
        return $this->belongsTo(ProjectMilestone::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function reviewee()
    {
        return $this->belongsTo(User::class, 'reviewee_id');
    }
}
