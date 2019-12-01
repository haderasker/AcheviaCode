<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via()
    {

        return [SmsChannel::class, 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');

//        $url = url('/invoice/'.$this->invoice->id);
//
//        return (new MailMessage)
//            ->greeting('Hello!')
//            ->line('One of your invoices has been paid!')
//            ->action('View Invoice', $url)
//            ->line('Thank you for using our application!');
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        $phone = $notifiable['countryCode'] . ltrim($notifiable['phone'], '0');
        $myBody = [
            'username' => env('SMS_USERNAME'),
            'password' => env('SMS_PASSWORD'),
            'sender' => env('SMS_SENDER'),
            'language' => 1,
            'mobile' => $phone,
            'message' => 'welcome',
//            'delayUntil' => $delayUntil,
        ];

        return $myBody;

    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }


}