<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Notifications\Events\NotificationSent;
use App\Listeners\BroadcastNotificationListener;
use App\Listeners\LogMessagingEvent;
use App\Events\MessageDelivered;
use App\Events\MessageRead;
use App\Events\MessageSent;
use App\Events\TypingStarted;
use App\Events\TypingStopped;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\LinkedIn\LinkedInExtendSocialite::class.'@handle',
            \SocialiteProviders\Google\GoogleExtendSocialite::class.'@handle',
            \SocialiteProviders\Facebook\FacebookExtendSocialite::class.'@handle'
        ],
        NotificationSent::class => [
            BroadcastNotificationListener::class,
        ],
        MessageSent::class => [
            LogMessagingEvent::class,
        ],
        MessageDelivered::class => [
            LogMessagingEvent::class,
        ],
        MessageRead::class => [
            LogMessagingEvent::class,
        ],
        TypingStarted::class => [
            LogMessagingEvent::class,
        ],
        TypingStopped::class => [
            LogMessagingEvent::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
