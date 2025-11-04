<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TypingStopped implements ShouldBroadcastNow
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
        return 'typing.stopped';
    }

    public function broadcastWith(): array
    {
        return [
            'conversation_id' => $this->conversationId,
            'user_id' => $this->userId,
        ];
    }
}
