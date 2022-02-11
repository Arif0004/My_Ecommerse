<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected  $attributes = [
        'admin_id' => 1
    ];
    protected $with = ['replies'];
    function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    function replies(): HasMany
    {
        return $this->hasMany(MessageReply::class);
    }
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('H:i d, M Y');
    }
}
