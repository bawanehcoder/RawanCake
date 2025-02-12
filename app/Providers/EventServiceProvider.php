<?php

namespace App\Providers;

use App\Events\ReferralEvent;
use App\Listeners\ReferralListener;
use App\Models\OrderDetail;
use App\Observers\OrderDetailObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        ReferralEvent::class => [
            ReferralListener::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // ... other providers
            \SocialiteProviders\Instagram\InstagramExtendSocialite::class.'@handle',
        ],

        \App\Events\SyncStarted::class => [
            \App\Listeners\SendNotificationToAdmin::class,
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        OrderDetail::observe(OrderDetailObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
