<?php

namespace App\Events\Hourly;

use App\Models\Payment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentReleased implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Payment $payment)
    {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('user.' . $this->payment->payee_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'payment.released';
    }

    public function broadcastWith(): array
    {
        return [
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->freelancer_amount,
            'invoice_id' => $this->payment->invoice_id,
        ];
    }
}

