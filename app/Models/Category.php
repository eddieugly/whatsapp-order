<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'ulid',
        'name',
        'description',
        'thumbnail'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->ulid = (string) Str::ulid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    public function menu() : HasMany {
        return $this->hasMany(Menu::class);
    }
}
