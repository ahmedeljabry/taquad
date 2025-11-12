<?php

namespace App\Events\Hourly;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoicePaymentProcessed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Invoice $invoice,
        public Payment $payment
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('user.' . $this->invoice->contract->freelancer_id),
            new Channel('user.' . $this->invoice->contract->client_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'invoice.payment_processed';
    }

    public function broadcastWith(): array
    {
        return [
            'invoice_id' => $this->invoice->id,
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->amount,
        ];
    }
}

