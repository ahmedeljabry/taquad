<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserNotificationSetting;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get user verification
     *
     * @return object
     */
    public function verification()
    {
        return $this->hasOne(VerificationCenter::class, 'user_id');
    }


    /**
     * Get user avatar
     *
     * @return object
     */
    public function avatar()
    {
        return $this->belongsTo(FileManager::class, 'avatar_id');
    }

    /**
     * Get user billing info
     *
     * @return object
     */
    public function billing()
    {
        return $this->hasOne(UserBilling::class, 'user_id');
    }

    /**
     * Get user level
     *
     * @return object
     */
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    /**
     * Get user country
     *
     * @return object
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Get user skills
     *
     * @return object
     */
    public function skills()
    {
        return $this->hasMany(UserSkill::class, 'user_id');
    }

    /**
     * Get user linked account
     *
     * @return object
     */
    public function accounts()
    {
        return $this->hasOne(UserLinkedAccount::class, 'user_id');
    }

    /**
     * Get user projects
     *
     * @return object
     */
    public function projects()
    {
        return $this->hasMany(UserPortfolio::class, 'user_id');
    }

    /**
     * Get user languages
     *
     * @return object
     */
    public function languages()
    {
        return $this->hasMany(UserLanguage::class, 'user_id');
    }

    /**
     * Get user availability
     *
     * @return object
     */
    public function availability()
    {
        return $this->hasOne(UserAvailability::class, 'user_id');
    }

    /**
     * Check if user online
     *
     * @return boolean
     */
    public function isOnline(){
        return Cache::has('user-is-online-'. $this->id);
    }

    /**
     * Get seller reviews
     *
     * @return object
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'seller_id');
    }

    public function projectReviewsGiven()
    {
        return $this->hasMany(ProjectReview::class, 'reviewer_id');
    }

    public function projectReviewsReceived()
    {
        return $this->hasMany(ProjectReview::class, 'reviewee_id');
    }

    public function freelancerProjectLevel()
    {
        return $this->belongsTo(ProjectLevel::class, 'freelancer_project_level_id');
    }

    public function clientProjectLevel()
    {
        return $this->belongsTo(ProjectLevel::class, 'client_project_level_id');
    }

    public function getFreelancerLevelBadgeAttribute(): ?array
    {
        $level = $this->freelancerProjectLevel;

        if (!$level) {
            return null;
        }

        return [
            'label'       => $level->label,
            'badge_color' => $level->badge_color,
            'text_color'  => $level->text_color,
        ];
    }

    public function getClientLevelBadgeAttribute(): ?array
    {
        $level = $this->clientProjectLevel;

        if (!$level) {
            return null;
        }

        return [
            'label'       => $level->label,
            'badge_color' => $level->badge_color,
            'text_color'  => $level->text_color,
        ];
    }

    /**
     * Get seller rating
     *
     * @return integer
     */
    public function rating()
    {
        try {
            
            // Get total rating
            $total_rating  = $this->reviews()->sum('rating');

            // Get total reviews
            $total_reviews = $this->reviews()->count();

            // Get rating
            $rating_value = $total_reviews === 0 ? 0 : $total_rating / $total_reviews;

            // Check if decimal
            if (is_numeric( $rating_value ) && floor( $rating_value ) != $rating_value) {
                return number_format($rating_value, 1);
            } else {
                return $rating_value;
            }

        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function projectRating(): float
    {
        return round((float) $this->project_rating_avg, 2);
    }

    public function clientRating(): float
    {
        return round((float) $this->client_rating_avg, 2);
    }

    /**
     * Get notifications
     *
     * @return object
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function notificationSettings()
    {
        return $this->hasOne(UserNotificationSetting::class, 'user_id');
    }

    /**
     * Get user's restrictions
     *
     * @return object
     */
    public function restrictions() : object
    {
        return $this->hasMany(UserRestriction::class, 'user_id');
    }

    public function conversationParticipants()
    {
        return $this->hasMany(ConversationParticipant::class, 'user_id');
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_participants', 'user_id', 'conversation_id')
            ->withPivot(['role', 'joined_at', 'last_read_at', 'unread_count', 'settings'])
            ->withTimestamps();
    }

    public function contacts()
    {
        return $this->conversations()
            ->with('participants.user')
            ->get()
            ->flatMap(function (Conversation $conversation) {
                return $conversation->participants
                    ->pluck('user')
                    ->filter();
            })
            ->filter(fn ($user) => $user->id !== $this->id)
            ->unique('id')
            ->values();
    }
}
