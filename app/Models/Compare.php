<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compare extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function scopeMyProducts($query)
    {
        return $query->whereCustomerId(auth('customer')->id());
    }
    function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
