<?php

namespace App\Events\Hourly;

use App\Models\Contract;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContractEnded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Contract $contract,
        public int $endedBy,
        public string $reason,
        public array $options = []
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('user.' . $this->contract->client_id),
            new Channel('user.' . $this->contract->freelancer_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'contract.ended';
    }

    public function broadcastWith(): array
    {
        return [
            'contract_id' => $this->contract->id,
            'project_id' => $this->contract->project_id,
            'ended_by' => $this->endedBy,
            'reason' => $this->reason,
        ];
    }
}

