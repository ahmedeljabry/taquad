<?php

namespace App\Events\Realtime;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserNotificationBroadcast implements ShouldBroadcastNow
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public int $userId,
        public string $key,
        public array $payload = []
    ) {
    }

    public function broadcastOn(): array
    {
        $prefix = config('reverb.channels.notification_prefix', 'user');

        return [
            new PrivateChannel(sprintf('%s.%d', $prefix, $this->userId)),
        ];
    }

    public function broadcastAs(): string
    {
        return $this->key;
    }

    public function broadcastWith(): array
    {
        return $this->payload;
    }
}
