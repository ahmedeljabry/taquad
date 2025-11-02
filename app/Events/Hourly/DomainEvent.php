<?php

namespace App\Events\Hourly;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DomainEvent implements ShouldBroadcastNow
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param  array<int, int>  $userIds
     */
    public function __construct(
        public string $key,
        public array $payload,
        public array $userIds = [],
        public ?int $contractId = null,
    ) {
    }

    public function broadcastOn(): array
    {
        $channels = [];
        $userPrefix = config('hourly.channels.user', 'user');
        $contractPrefix = config('hourly.channels.contract', 'contract');

        foreach ($this->userIds as $userId) {
            $channels[] = new PrivateChannel(sprintf('%s.%d', $userPrefix, $userId));
        }

        if ($this->contractId) {
            $channels[] = new PrivateChannel(sprintf('%s.%d', $contractPrefix, $this->contractId));
        }

        return $channels;
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
