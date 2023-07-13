<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class General extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $casts = [
        'company_seo_keywords' => 'array',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($general) {
            $general->ulid = (string) Str::ulid();
        });
    }
}
