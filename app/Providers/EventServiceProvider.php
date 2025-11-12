<?php

namespace App\Providers;

use App\Events\Hourly\ContractEnded;
use App\Events\Hourly\ContractPaused;
use App\Events\Hourly\ContractResumed;
use App\Events\Hourly\InvoiceDisputed;
use App\Events\Hourly\InvoicePaymentProcessed;
use App\Events\Hourly\InvoiceReviewed;
use App\Events\Hourly\OfferDeclined;
use App\Events\Hourly\OfferSent;
use App\Events\Hourly\PaymentReleased;
use App\Events\Hourly\ProposalWithdrawn;
use App\Listeners\Hourly\SendInvoiceReadyNotification;
use App\Listeners\Hourly\SendOfferDeclinedNotification;
use App\Listeners\Hourly\SendOfferNotification;
use App\Listeners\Hourly\SendPaymentReleasedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        
        // Hourly contract lifecycle events
        OfferSent::class => [
            SendOfferNotification::class,
        ],
        OfferDeclined::class => [
            SendOfferDeclinedNotification::class,
        ],
        ProposalWithdrawn::class => [
            // Add listeners if needed
        ],
        ContractPaused::class => [
            // Add listeners if needed
        ],
        ContractResumed::class => [
            // Add listeners if needed
        ],
        ContractEnded::class => [
            // Add listeners if needed
        ],
        
        // Invoice and payment events
        InvoiceReviewed::class => [
            SendInvoiceReadyNotification::class,
        ],
        InvoicePaymentProcessed::class => [
            // Add listeners if needed
        ],
        InvoiceDisputed::class => [
            // Add listeners if needed
        ],
        PaymentReleased::class => [
            SendPaymentReleasedNotification::class,
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
