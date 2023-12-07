<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extra extends Model
{
    use HasFactory;

    protected $casts = [
        'is_required' => 'boolean',
    ];

    protected $fillable = [
        'ulid',
        'name',
        'is_required',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($extra) {
            $extra->ulid = (string) Str::ulid();
        });
    }
}