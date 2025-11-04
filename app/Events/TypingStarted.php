<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TypingStarted implements ShouldBroadcastNow
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public int $conversationId, public int $userId)
    {
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('private.typing.conversation.' . $this->conversationId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'typing.started';
    }

    public function broadcastWith(): array
    {
        return [
            'conversation_id' => $this->conversationId,
            'user_id' => $this->userId,
        ];
    }
}
