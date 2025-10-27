<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_portfolio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'user_id',
        'title',
        'slug',
        'description',
        'thumb_id',
        'project_link',
        'project_video',
        'status',
        'views_count',
        'likes_count',
    ];

    protected $casts = [
        'views_count' => 'integer',
        'likes_count' => 'integer',
    ];

    /**
     * Get project gallery
     *
     * @return object
     */
    public function gallery()
    {
        return $this->hasMany(UserPortfolioGallery::class, 'project_id');
    }

    /**
     * Get thumbnail
     *
     * @return object
     */
    public function thumbnail()
    {
        return $this->belongsTo(FileManager::class, 'thumb_id');
    }

    /**
     * Get user
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function visits()
    {
        return $this->hasMany(UserPortfolioVisit::class, 'portfolio_id');
    }

    public function likes()
    {
        return $this->hasMany(UserPortfolioLike::class, 'portfolio_id');
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'user_portfolio_likes', 'portfolio_id', 'user_id');
    }
}
