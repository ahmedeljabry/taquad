<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBriefQuestion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_brief_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'project_id',
        'question',
        'is_required',
        'position',
    ];

    /**
     * Get the project for this question.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
