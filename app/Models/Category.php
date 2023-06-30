<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    protected $fillable = [
        'ulid',
        'name',
        'slug',
        'description',
        'thumbnail',
        'status',
        'featured',
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

    function scopeActive($builder) : Scope {
        return $builder->where('active', true);
    }

    function scopeInActive($builder) : Scope {
        return $builder->where('active', false);
    }

    function scopeFeatured($builder) : Scope {
        return $builder->where('featured', true);
    }
}
