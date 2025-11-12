<?php

namespace App\Listeners\Hourly;

use App\Events\Hourly\OfferDeclined;
use App\Notifications\Hourly\OfferDeclinedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOfferDeclinedNotification implements ShouldQueue
{
    public function handle(OfferDeclined $event): void
    {
        $event->contract->loadMissing('client');
        
        if ($event->contract->client) {
            $event->contract->client->notify(
                new OfferDeclinedNotification($event->contract, $event->reason)
            );
        }
    }
}

