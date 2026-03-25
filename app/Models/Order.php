<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'buyer_id',
        'product_id',
        'status',
        'comment',
    ];

    /**
     * Get the buyer (customer) for this order.
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Get the product for this order.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the reviews for this order.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'order_id');
    }
}
