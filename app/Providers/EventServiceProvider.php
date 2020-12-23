<?php

namespace App\Providers;

use App\Events\ErrorUpdateEvent;
use App\Events\TicketNotificationEvent;
use App\Events\TicketReplyEvent;
use App\Events\TicketUpdateEvent;
use App\Listeners\AcknowledgedTicket;
use App\Listeners\SendEmailUpdateEvent;
use App\Listeners\SendEmailUpdateListener;
use App\Listeners\SendErrorUpdateListener;
use App\Listeners\SendReplyListener;
use App\Listeners\TicketReplyListener;
use App\Listeners\TicketUpdateListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
