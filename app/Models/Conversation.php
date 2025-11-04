<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'project_id',
        'created_by',
        'last_message_id',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Conversation $conversation) {
            if (empty($conversation->uid)) {
                $conversation->uid = Str::ulid()->toBase32();
            }
        });
    }

    public function participants(): HasMany
    {
        return $this->hasMany(ConversationParticipant::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Scope the query to conversations that include the given user.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->whereHas('participants', fn ($relation) => $relation->where('user_id', $userId));
    }

    public function latestMessage(): HasOne
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lastMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }

    public function participantFor(User|int $user): ?ConversationParticipant
    {
        $userId = $user instanceof User ? $user->getKey() : $user;

        return $this->participants
            ->firstWhere('user_id', $userId);
    }

    public function otherParticipant(User|int $user): ?ConversationParticipant
    {
        $userId = $user instanceof User ? $user->getKey() : $user;

        return $this->participants
            ->first(fn (ConversationParticipant $participant) => $participant->user_id !== $userId);
    }
}
