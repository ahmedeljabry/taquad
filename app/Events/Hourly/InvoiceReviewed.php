<?php

namespace App\Events\Hourly;

use App\Models\Invoice;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceReviewed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Invoice $invoice,
        public bool $approved,
        public ?string $notes = null
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
        return 'invoice.reviewed';
    }

    public function broadcastWith(): array
    {
        return [
            'invoice_id' => $this->invoice->id,
            'approved' => $this->approved,
            'status' => $this->invoice->status->value,
        ];
    }
}

