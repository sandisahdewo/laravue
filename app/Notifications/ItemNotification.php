<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ItemNotification extends Notification
{
    use Queueable;

    protected $items;

    protected $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($items, $status)
    {
        $this->items = $items;

        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'item_code' => $this->items->code,
            'item_name' => $this->items->name,
            'status' => $this->status
        ];
    }
}
