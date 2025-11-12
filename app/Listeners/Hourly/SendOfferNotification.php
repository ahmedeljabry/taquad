<?php

namespace App\Listeners\Hourly;

use App\Events\Hourly\OfferSent;
use App\Notifications\Hourly\OfferSentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOfferNotification implements ShouldQueue
{
    public function handle(OfferSent $event): void
    {
        $event->freelancer->notify(new OfferSentNotification($event->contract));
    }
}

