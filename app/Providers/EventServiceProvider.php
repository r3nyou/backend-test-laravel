<?php

namespace App\Providers;

use App\Events\Teacher\Appointment\Book as BookAppointment;
use App\Events\Teacher\Appointment\Cancel as CancelAppointment;
use App\Listeners\Channels\ViaEmail;
use App\Listeners\Channels\ViaTelegram;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BookAppointment::class => [
            ViaEmail::class,
            ViaTelegram::class,
        ],
        CancelAppointment::class => [
            ViaEmail::class,
            ViaTelegram::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
