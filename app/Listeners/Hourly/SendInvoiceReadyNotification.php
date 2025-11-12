<?php

namespace App\Listeners\Hourly;

use App\Events\Hourly\InvoiceReviewed;
use App\Notifications\Hourly\InvoiceReadyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvoiceReadyNotification implements ShouldQueue
{
    public function handle($event): void
    {
        if (!isset($event->invoice)) {
            return;
        }

        $event->invoice->loadMissing(['contract', 'contract.client']);
        
        if ($event->invoice->contract && $event->invoice->contract->client) {
            $event->invoice->contract->client->notify(
                new InvoiceReadyNotification($event->invoice)
            );
        }
    }
}

