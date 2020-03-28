<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database',TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    // fungsi ini akan menyimpan data ke dalam field "data" pada table notifications
    public function toDatabase($notifiable)
    {
        // just dummy data
        return [
            'amount' => 10000,
            'invoice_action' => 'Pay now...'
        ];
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            // Optional recipient user id.      // contoh disini adalah group "Notification Laravel"
//            ->to('-372888180')                // bisa menggunakan integer chat id
//            ->to($notifiable->telegram_id)    // bisa mengambil dari database telegram_id
            ->to('@notificationlaravel')  // atau id group chat
            // Markdown supported.
            ->content("Hello there!")
            // (Optional) Inline Buttons
            ->button('View Google', 'www.google.com');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
