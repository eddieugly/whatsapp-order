<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'ulid',
        'category_id',
        'name',
        'description',
        'status',
        'price',
        'thumbnail'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->ulid = (string) Str::ulid();
        });
    }

    protected function price() : Attribute {
        return Attribute::make(
            get: fn (string $value) => number_format($value, 2),
        );
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive() : Scope {
        return $this->where('status', 1);
    }
}
