<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'name',
        'slug',
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
        'rating',
        'meta_title',
        'meta_description',
        'views_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_active' => 'boolean',
        'status' => 'boolean',
        'images' => 'array',
        'tags' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug if not provided
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            
            // Ensure slug is unique
            $originalSlug = $product->slug;
            $counter = 1;
            
            while (static::where('slug', $product->slug)->exists()) {
                $product->slug = $originalSlug . '-' . $counter++;
            }
        });

        // Update slug when name changes
        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                
                // Ensure slug is unique
                $originalSlug = $product->slug;
                $counter = 1;
                
                while (static::where('slug', $product->slug)->where('id', '!=', $product->id)->exists()) {
                    $product->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

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
     * Get the approved reviews for the product.
     */
    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
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
     * Scope a query to only include products on sale.
     */
    public function scopeOnSale($query)
    {
        return $query->whereNotNull('sale_price')
                     ->whereColumn('sale_price', '<', 'price');
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to filter by vendor.
     */
    public function scopeByVendor($query, $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    /**
     * Scope a query to search products.
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('name', 'LIKE', "%{$term}%")
              ->orWhere('description', 'LIKE', "%{$term}%")
              ->orWhere('sku', 'LIKE', "%{$term}%")
              ->orWhere('tags', 'LIKE', "%{$term}%");
        });
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

    /**
     * Get all images with full URLs.
     */
    public function getImageUrlsAttribute()
    {
        if (!$this->images) {
            return [];
        }
        
        return array_map(function($image) {
            return asset('storage/' . $image);
        }, $this->images);
    }

    /**
     * Get the average rating from reviews.
     */
    public function getAverageRatingAttribute()
    {
        return $this->approvedReviews()->avg('rating') ?? 0;
    }

    /**
     * Get the total number of reviews.
     */
    public function getReviewsCountAttribute()
    {
        return $this->approvedReviews()->count();
    }

    /**
     * Check if product is in stock.
     */
    public function getInStockAttribute()
    {
        return $this->stock > 0;
    }

    /**
     * Get stock status label.
     */
    public function getStockStatusAttribute()
    {
        if ($this->stock > 10) {
            return ['label' => 'In Stock', 'class' => 'text-success'];
        } elseif ($this->stock > 0) {
            return ['label' => 'Low Stock', 'class' => 'text-warning'];
        }
        return ['label' => 'Out of Stock', 'class' => 'text-danger'];
    }

    /**
     * Get related products from same category.
     */
    public function relatedProducts($limit = 4)
    {
        return self::where('category_id', $this->category_id)
                   ->where('id', '!=', $this->id)
                   ->where('is_active', true)
                   ->inStock()
                   ->limit($limit)
                   ->get();
    }

    /**
     * Get products from same vendor.
     */
    public function moreFromVendor($limit = 4)
    {
        return self::where('vendor_id', $this->vendor_id)
                   ->where('id', '!=', $this->id)
                   ->where('is_active', true)
                   ->limit($limit)
                   ->get();
    }

    /**
     * Increment view count.
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Update stock after order.
     */
    public function decreaseStock($quantity)
    {
        if ($this->stock >= $quantity) {
            $this->decrement('stock', $quantity);
            $this->increment('sold_count', $quantity);
            return true;
        }
        return false;
    }

    /**
     * Get the URL for the product.
     */
    public function getUrlAttribute()
    {
        return route('product.show', $this->slug);
    }

    /**
     * Get the share text for social media.
     */
    public function getShareTextAttribute()
    {
        return "Check out this product: " . $this->name . " - " . $this->formatted_price;
    }
}