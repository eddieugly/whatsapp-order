<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blogcategory extends Model
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

        static::creating(function ($blogcategory) {
            $blogcategory->ulid = (string) Str::ulid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    // public function menu() : HasMany {
    //     return $this->hasMany(Menu::class);
    // }

    function scopeActive($builder) {
        return $builder->where('status', true);
    }

    function scopeInActive($builder) {
        return $builder->where('status', false);
    }

    function scopeFeatured($builder) {
        return $builder->where('featured', true);
    }

    function scopeNotFeatured($builder) {
        return $builder->where('featured', false);
    }
}
