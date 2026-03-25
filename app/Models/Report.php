<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $primaryKey = 'report_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'reason',
    ];

    /**
     * Get the user who reported this product.
     */
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the product being reported.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
