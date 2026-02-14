<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'name',
        'description',
        'price',
        'sale_price',
        'stock',
        'sku',
        'category_id',
        'category',
        'images',
        'tags',
        'is_active',
        'status',
        'sold_count',
        'rating'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_active' => 'boolean',
        'status' => 'boolean',
        'images' => 'array',
        'tags' => 'array'
    ];

    /**
     * Get the vendor that owns the product.
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    /**
     * Get the category that the product belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the orders for the product through order items.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
                    ->withPivot('quantity', 'price', 'total')
                    ->withTimestamps();
    }

    /**
     * Get the reviews for the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->where('is_active', true)
              ->orWhere('status', true);
        });
    }

    /**
     * Scope a query to only include products in stock.
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return 'ETB ' . number_format($this->price, 2);
    }

    /**
     * Get the formatted sale price.
     */
    public function getFormattedSalePriceAttribute()
    {
        return $this->sale_price ? 'ETB ' . number_format($this->sale_price, 2) : null;
    }

    /**
     * Get the discount percentage if on sale.
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->sale_price && $this->sale_price < $this->price) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    /**
     * Check if product is on sale.
     */
    public function getIsOnSaleAttribute()
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }

    /**
     * Get the first image or default.
     */
    public function getFirstImageAttribute()
    {
        if ($this->images && count($this->images) > 0) {
            return $this->images[0];
        }
        return null;
    }
}