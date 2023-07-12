<?php

namespace App\Models;

use App\Casts\PurifyHtml;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;



    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'slider' => 'boolean',
        'description' => PurifyHtml::class,
    ];

    protected $fillable = [
        'ulid',
        'blogcategory_id',
        'title',
        'slug',
        'description',
        'price',
        'status',
        'featured',
        'slider',
        'thumbnail'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->ulid = (string) Str::ulid();
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

    public function blogcategory() : BelongsTo {
        return $this->belongsTo(Blogcategory::class);
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
