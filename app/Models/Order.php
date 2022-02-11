<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    HasMany
};


class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    function scopeMyOrders($query)
    {
        //return $query->where('customer_id', auth('customer')->id());
        return $query->whereBelongsTo(auth('customer')->user());
    }

    function scopePending($query)
    {
        return $query->whereStatus('pending');
    }

    function scopeOnGoing($query)
    {
        return $query->whereStatus('ongoing');
    }

    function scopeReceived($query)
    {
        return $query->whereStatus('received');
    }

    public function getRouteKeyName()
    {
        return 'unique_id';
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
    public function products(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
