<?php

namespace App\Listeners;

use App\Events\Realtime\UserNotificationBroadcast;
use Illuminate\Notifications\Events\NotificationSent;

class BroadcastNotificationListener
{
    public function handle(NotificationSent $event): void
    {
        $notifiable = $event->notifiable;

        if (! $notifiable || ! method_exists($notifiable, 'getKey')) {
            return;
        }

        $userId = (int) $notifiable->getKey();

        $payload = [];

        if (method_exists($event->notification, 'toArray')) {
            $payload = (array) $event->notification->toArray($notifiable);
        }

        try {
            event(new UserNotificationBroadcast(
                $userId,
                'notification.sent',
                array_merge([
                    'type'    => get_class($event->notification),
                    'channel' => $event->channel,
                ], $payload)
            ));
        } catch (\Throwable $th) {
            report($th);
        }
    }
}