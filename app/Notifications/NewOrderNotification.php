<?php

namespace App\Notifications;

use App\Models\General;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $general = General::first();
        return (new MailMessage)
                    ->from($general->company_email, $general->company_name)
                    ->bcc($general->company_email, $general->company_name)
                    ->subject('New Order')
                    ->greeting("Hello {$this->order->customer_name}!")
                    ->line("Your order has been placed")
                    ->line("#{$this->order->ulid} is currently been processed")
                    ->line('Thank you for your patronage!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->order->ulid,
            'name' => $this->order->customer_email,
            'email' => $this->order->customer_email,
            'phone' => $this->order->customer_phone,
            'amount' => $this->order->amount,
            'status' => $this->order->order_status,
            'payment_status' => $this->order->payment_status,
            'items' => $this->order->cart,
        ];
    }
}
