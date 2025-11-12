<?php

namespace App\Events\Hourly;

use App\Models\Contract;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContractTermsUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Contract $contract,
        public array $updates
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('user.' . $this->contract->freelancer_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'contract.terms_updated';
    }

    public function broadcastWith(): array
    {
        return [
            'contract_id' => $this->contract->id,
            'project_id' => $this->contract->project_id,
            'updates' => $this->updates,
        ];
    }
}

