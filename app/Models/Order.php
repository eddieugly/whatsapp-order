<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Broadcasting\PrivateChannel;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $casts = [
        'cart' => 'array',
    ];

    protected $fillable = [
        'ulid',
        'user_id',
        'amount',
        'customer_name',
        'customer_email',
        'customer_phone',
        'cart',
        'addon',
        'tx_ref',
        'payment_method',
        'payment_status',
        'order_status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->ulid = (string) Str::ulid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value / 100,
            set: fn (string $value) => $value * 100,
        );
    }

        /**
     * Route notifications for the mail channel.
     *
     * @return  array<string, string>|string
     */
    public function routeNotificationForMail(Notification $notification): array|string
    {
        // Return email address and name...
        return [$this->customer_email => $this->customer_name];
    }

    /**
     * The channels the user receives notification broadcasts on.
     */
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'orders';
    }
    
    public function scopePaymentFailed($builder) {
        return $builder->where('payment_status', 0);
    }

    public function scopePaymentPending($builder) {
        return $builder->where('payment_status', 1);
    }

    public function scopePaymentCompleted($builder) {
        return $builder->where('payment_status', 2);
    }

    public function scopePayOnPickup($builder) {
        return $builder->where('payment_method', 0);
    }

    public function scopePayNow($builder) {
        return $builder->where('payment_method', 1);
    }

    public function scopeOrderCancelled($builder) {
        return $builder->where('order_status', 0);
    }

    public function scopeOrderPending($builder) {
        return $builder->where('order_status', 1);
    }

    public function scopeOrderCompleted($builder) {
        return $builder->where('order_status', 2);
    }

    public function scopeOrderPicked($builder) {
        return $builder->where('order_status', 3);
    }
}
