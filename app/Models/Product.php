<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type',
        'material',
        'production_time',
        'status',
    ];

    /**
     * Get the user (maker) that created this product.
     */
    public function maker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the orders for this product.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'product_id');
    }

    /**
     * Get the reviews for this product.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    /**
     * Get the reports for this product.
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'product_id');
    }
}
