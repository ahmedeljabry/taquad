<?php

namespace App\Listeners\Hourly;

use App\Events\Hourly\PaymentReleased;
use App\Notifications\Hourly\PaymentReleasedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPaymentReleasedNotification implements ShouldQueue
{
    public function handle(PaymentReleased $event): void
    {
        $event->payment->loadMissing('payee');
        
        if ($event->payment->payee) {
            $event->payment->payee->notify(
                new PaymentReleasedNotification($event->payment)
            );
        }
    }
}

