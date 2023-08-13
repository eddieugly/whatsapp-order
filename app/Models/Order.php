<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
