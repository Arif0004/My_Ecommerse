<?php

namespace App\Models;


use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\Models\Scopes\ProductScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, ProductScope;
    protected $guarded = [];
    protected $with = ['color', 'size', 'category', 'sub_category', 'info', 'sliders'];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
    public function scopeSimilar($query, $id)
    {
        return $query->where('category_id', $id);
    }
    public function scopeSorting($query, $option)
    {
        if ($option === 'latest') {
            return $query->latest();
        }
        if ($option === 'older') {
            return $query->oldest();
        }
        if ($option === 'popularity') {

            return $query->whereHas('reviews')->latest();
        }
        if ($option === 'best_selling') {

            return $query->BestSelling();
        }
    }

    function scopeIsActive($query)
    {
        return $query->whereHas('info', function ($query) {
            $query->isActive();
        });
    }
    function scopeIsFeatured($query)
    {
        return $query->whereHas('info', function ($query) {
            $query->isFeatured();
        });
    }
    function scopeBestSelling($query)
    {
        return $query->whereHas('orders')->latest();
    }

    public static function booted()
    {
        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->whereHas('info', function ($query) {
                $query->isActive();
            });
        });
    }

    public function info()
    {
        return $this->hasOne(ProductInfo::class, 'product_id');
    }
    public function sliders()
    {
        return $this->hasMany(ProductSlider::class, 'product_id');
    }

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    function sub_category()
    {
        return $this->belongsTo(Category::class, 'sub_cat_id');
    }
    function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
    // public function popularProducts()
    // {
    //     return $this->hasOne(Review::class, 'product_id')->ofMany('rating', 'max');
    // }
}
