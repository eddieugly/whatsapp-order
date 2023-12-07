<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExtraOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'ulid',
        'extra_id',
        'name',
        'price',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($extra_option) {
            $extra_option->ulid = (string) Str::ulid();
        });
    }
}
