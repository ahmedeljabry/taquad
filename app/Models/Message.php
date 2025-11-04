<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'conversation_id',
        'user_id',
        'type',
        'body',
        'meta',
        'edited_at',
        'delivered_at',
        'sent_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'edited_at' => 'datetime',
        'delivered_at' => 'datetime',
        'sent_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = [
        'sender_id',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(MessageAttachment::class);
    }

    public function author(): BelongsTo
    {
        return $this->sender();
    }

    public function getSenderIdAttribute(): ?int
    {
        return $this->user_id;
    }

    public function setSenderIdAttribute($value): void
    {
        $this->attributes['user_id'] = $value;
    }

    public function markAsDelivered(): void
    {
        if (! $this->delivered_at) {
            $this->forceFill(['delivered_at' => now()])->save();
        }
    }
}
