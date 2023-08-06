<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array',
    ];

    protected $fillable = [
        'ulid',
        'user_id',
        'amount',
        'customer_name',
        'customer_email',
        'customer_phone',
        'items',
        'addon',
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
}
