<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_milestones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'project_id',
        'created_by',
        'freelancer_id',
        'employer_id',
        'amount',
        'description',
        'parent_milestone_id',
        'is_follow_up',
        'status',
        'employer_commission',
        'freelancer_commission'
    ];

    /**
     * Get project
     *
     * @return object
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Get freelancer
     *
     * @return object
     */
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    /**
     * Get employer
     *
     * @return object
     */
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_milestone_id');
    }

    public function followUps()
    {
        return $this->hasMany(self::class, 'parent_milestone_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProjectReview::class, 'milestone_id');
    }
}
