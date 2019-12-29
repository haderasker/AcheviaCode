<?php

namespace App\Listeners;

use App\Events\PushNotificationEvent;
use App\Notifications\PushNotification;
use Illuminate\Support\Facades\Notification;

class PushNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle(PushNotificationEvent $event)
    {
        Notification::send([$event], new PushNotification());
    }
}
