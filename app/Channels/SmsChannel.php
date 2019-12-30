<?php

namespace App\Channels;

use App\Notifications\UserNotification;
use GuzzleHttp;

class SmsChannel
{
    private $apiRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->apiRequest = new GuzzleHttp\Client();
    }

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \App\Notifications\UserNotification $notification
     * @return void
     */
    public function send($notifiable, UserNotification $notification): void
    {
        $message = $notification->toSms($notifiable);
        if ($message != null) {
            $this->apiRequest->post(env('SMS_ENDPOINT'), ['query' => $message]);
        }
    }
}