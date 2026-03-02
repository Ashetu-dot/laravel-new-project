<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionUsage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'promotion_id',
        'user_id',
        'order_id',
        'discount_amount',
        'metadata'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'discount_amount' => 'decimal:2',
        'metadata' => 'array'
    ];

    /**
     * Get the promotion that owns this usage.
     */
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    /**
     * Get the user that used this promotion.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order where this promotion was used.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}