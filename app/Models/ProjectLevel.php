<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'account_type',
        'label',
        'badge_color',
        'text_color',
        'min_completed_projects',
        'min_rating_count',
        'min_rating',
        'priority',
    ];

    public function scopeForAccountType($query, string $accountType)
    {
        return $query->where('account_type', $accountType);
    }

    public function freelancers()
    {
        return $this->hasMany(User::class, 'freelancer_project_level_id');
    }

    public function clients()
    {
        return $this->hasMany(User::class, 'client_project_level_id');
    }
}
