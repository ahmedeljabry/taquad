<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Message $message)
    {
        $this->message->loadMissing([
            'conversation.participants.user:id,username,fullname,avatar_id',
            'conversation',
            'sender:id,username,fullname,avatar_id',
            'attachments',
        ]);
    }

    public function broadcastOn(): array
    {
        $conversationId = $this->message->conversation_id;
        $presenceChannel = new PresenceChannel('presence.conversation.' . $conversationId);

        $userChannels = collect($this->message->conversation?->participants ?? [])
            ->pluck('user_id')
            ->filter()
            ->unique()
            ->map(fn (int $userId) => new PrivateChannel('user.' . $userId))
            ->all();

        return array_merge([$presenceChannel], $userChannels);
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    public function broadcastWith(): array
    {
        $message = $this->message;
        $sender = $message->sender;
        $conversation = $message->conversation;

        return [
            'conversation_id' => $conversation->id,
            'message' => [
                'id' => $message->id,
                'conversation_id' => $message->conversation_id,
                'user_id' => $message->user_id,
                'body' => $message->body,
                'type' => $message->type,
                'meta' => $message->meta,
                'edited_at' => optional($message->edited_at)->toIso8601String(),
                'delivered_at' => optional($message->delivered_at)->toIso8601String(),
                'sent_at' => optional($message->sent_at ?? $message->created_at)->toIso8601String(),
                'created_at' => optional($message->created_at)->toIso8601String(),
                'state' => $message->delivered_at ? 'delivered' : 'sent',
                'attachments' => $message->attachments->map(function ($attachment) {
                    return [
                        'id' => $attachment->id,
                        'disk' => $attachment->disk,
                        'path' => $attachment->path,
                        'original_name' => $attachment->original_name,
                        'mime' => $attachment->mime,
                        'size' => $attachment->size,
                        'url' => $attachment->url ?? null,
                    ];
                })->toArray(),
            ],
            'sender' => [
                'id' => $sender->id,
                'name' => $sender->fullname ?? $sender->username,
                'avatar' => function_exists('src') ? src($sender->avatar) : null,
            ],
        ];
    }
}
