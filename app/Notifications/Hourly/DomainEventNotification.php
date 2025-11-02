<?php

namespace App\Notifications\Hourly;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DomainEventNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected string $key,
        protected array $payload = []
    ) {
    }

    public function via(object $notifiable): array
    {
        $channels = ['database', 'broadcast'];
        $settings = method_exists($notifiable, 'notificationSettings')
            ? $notifiable->notificationSettings
            : null;

        if ($settings && $settings->isDndActive()) {
            return ['database'];
        }

        if ($settings) {
            $preferred = $settings->channels ?? [];

            if (! empty($preferred)) {
                $channels = array_values(array_intersect($channels, $preferred));
            }

            if ($settings->allowsChannel('mail')) {
                $channels[] = 'mail';
            }
        }

        return array_values(array_unique($channels));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'key'     => $this->key,
            'payload' => $this->payload,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject(__('notifications.hourly.subjects.' . $this->key))
            ->line(__('notifications.hourly.messages.' . $this->key, $this->payload));
    }
}
