<?php

namespace App\Events\Hourly;

use App\Models\Contract;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContractPaused implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Contract $contract,
        public int $pausedBy,
        public ?string $reason = null
    ) {
    }

    public function broadcastOn(): array
    {
        $channels = [
            new Channel('user.' . $this->contract->client_id),
            new Channel('user.' . $this->contract->freelancer_id),
        ];

        return $channels;
    }

    public function broadcastAs(): string
    {
        return 'contract.paused';
    }

    public function broadcastWith(): array
    {
        return [
            'contract_id' => $this->contract->id,
            'project_id' => $this->contract->project_id,
            'paused_by' => $this->pausedBy,
            'reason' => $this->reason,
        ];
    }
}

