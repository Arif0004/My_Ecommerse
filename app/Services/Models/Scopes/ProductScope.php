<?php

namespace App\Services\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait ProductScope
{
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
}
