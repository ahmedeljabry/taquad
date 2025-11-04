<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageRead implements ShouldBroadcastNow
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public int $conversationId,
        public int $messageId,
        public int $readerId,
        public ?string $readAt = null
    ) {
        $this->readAt ??= now()->toIso8601String();
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('private.reads.conversation.' . $this->conversationId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message.read';
    }

    public function broadcastWith(): array
    {
        return [
            'conversation_id' => $this->conversationId,
            'message_id' => $this->messageId,
            'reader_id' => $this->readerId,
            'read_at' => $this->readAt,
        ];
    }
}
