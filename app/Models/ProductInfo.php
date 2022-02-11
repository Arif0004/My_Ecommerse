<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeIsFeatured($query)
    {
        return $query->whereIsFeatured(true);
    }
    public function scopeIsActive($query)
    {
        return $query->whereIsActive(true);
    }
}
