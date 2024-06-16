<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;


class sendToUserNotification extends Notification
{
    use Queueable;

    private $pesan;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $pesan)
    {
        $this->pesan = $pesan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    public function toFcm($notifiable): FcmMessage
    {
        return (new FcmMessage(notification: new FcmNotification(
                title: 'Account Activated',
                body: 'Your account has been activated.',
                image: 'http://example.com/url-to-image-here.png'
            )))
            ->data(['data1' => 'value', 'data2' => 'value2']);
    }
}
