<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 12/28/19
 * Time: 12:57 AM
 */

namespace App\Channels;

use App\Notifications\PushNotification;
use GuzzleHttp;


class PushNotificationChannel
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
     * @param  \App\Notifications\PushNotification $notification
     * @return void
     */
    public function send($notifiable, PushNotification $notification): void
    {
        $headers = [
            'Authorization' => 'key=' . env('FCM_SERVER_KEY'),
            'Content-Type' => 'application/json',
        ];

        $message = $notification->toPushNotification($notifiable);

        $this->apiRequest->post(env('FCM_BASE_URL'), [
            'headers' => $headers,
            'json' => $message
        ]);
    }
}