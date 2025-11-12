<?php

namespace App\Events\Hourly;

use App\Models\Dispute;
use App\Models\Invoice;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceDisputed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Invoice $invoice,
        public Dispute $dispute
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('user.' . $this->invoice->contract->freelancer_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'invoice.disputed';
    }

    public function broadcastWith(): array
    {
        return [
            'invoice_id' => $this->invoice->id,
            'dispute_id' => $this->dispute->id,
            'reason' => $this->dispute->reason,
        ];
    }
}

