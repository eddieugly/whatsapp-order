<?php

namespace App\Models;

use App\Casts\PurifyHtml;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Menu extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'slider' => 'boolean',
        'has_extras' => 'boolean',
        'description' => PurifyHtml::class,
    ];

    protected $fillable = [
        'ulid',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'status',
        'featured',
        'slider',
        'has_extras',
        'thumbnail'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($menu) {
            $menu->ulid = (string) Str::ulid();
        });
    }

    // protected function price() : Attribute {
    //     return Attribute::make(
    //         get: fn (string $value) => number_format($value, 2),
    //     );
    // }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function extras() : BelongsToMany
    {
        return $this->belongsToMany(Extra::class, 'menu_extra');
    }

    public function extraOptions() : HasManyThrough
    {
        return $this->hasManyThrough(ExtraOption::class, Extra::class);
    }

    public function scopeActive($builder) {
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

    function scopeOnSlider($builder) {
        return $builder->where('slider', true);
    }

    function scopeNoSlider($builder) {
        return $builder->where('slider', false);
    }
}
