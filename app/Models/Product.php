<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
        'sold_count' => 'integer',
        'views_count' => 'integer',
        'rating' => 'decimal:2',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
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
            if ($product->isDirty('name')) {
                $newSlug = Str::slug($product->name);
                
                // Check if new slug is different and not already taken
                if ($newSlug !== $product->getOriginal('slug')) {
                    $originalSlug = $newSlug;
                    $counter = 1;
                    
                    while (static::where('slug', $newSlug)->where('id', '!=', $product->id)->exists()) {
                        $newSlug = $originalSlug . '-' . $counter++;
                    }
                    
                    $product->slug = $newSlug;
                }
            }
        });

        // Set default values for new products
        static::creating(function ($product) {
            if (!isset($product->is_active)) {
                $product->is_active = true;
            }
            if (!isset($product->status)) {
                $product->status = true;
            }
            if (!isset($product->sold_count)) {
                $product->sold_count = 0;
            }
            if (!isset($product->views_count)) {
                $product->views_count = 0;
            }
            if (!isset($product->rating)) {
                $product->rating = 0;
            }
        });

        // Log product creation for debugging
        static::created(function ($product) {
            Log::info('Product created: ' . $product->name . ' (ID: ' . $product->id . ')');
        });

        // Clean up related data when deleting
        static::deleting(function ($product) {
            // Delete order items
            $product->orderItems()->delete();
            
            // Delete reviews
            $product->reviews()->delete();
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
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    /**
     * Get the orders for the product through order items.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id')
                    ->withPivot('quantity', 'price', 'total')
                    ->withTimestamps();
    }

    /**
     * Get the reviews for the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    /**
     * Get the approved reviews for the product.
     */
    public function approvedReviews()
    {
        return $this->hasMany(Review::class, 'product_id')->where('is_approved', true);
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
     * Scope a query to get popular products (by views or sold count).
     */
    public function scopePopular($query, $limit = 10)
    {
        return $query->orderBy('views_count', 'desc')
                     ->orderBy('sold_count', 'desc')
                     ->limit($limit);
    }

    /**
     * Scope a query to get newly added products.
     */
    public function scopeNewest($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Scope a query to get top rated products.
     */
    public function scopeTopRated($query, $limit = 10)
    {
        return $query->orderBy('rating', 'desc')
                     ->orderBy('reviews_count', 'desc')
                     ->limit($limit);
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
        return $this->sale_price && $this->sale_price < $this->price && $this->sale_price > 0;
    }

    /**
     * Get the first image or default.
     */
    public function getFirstImageAttribute()
    {
        if ($this->images && is_array($this->images) && count($this->images) > 0) {
            return $this->images[0];
        }
        return null;
    }

    /**
     * Get all images with full URLs.
     */
    public function getImageUrlsAttribute()
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }
        
        return array_map(function($image) {
            // Check if it's already a full URL
            if (filter_var($image, FILTER_VALIDATE_URL)) {
                return $image;
            }
            return asset('storage/' . ltrim($image, '/'));
        }, $this->images);
    }

    /**
     * Get the placeholder image URL.
     */
    public function getPlaceholderImageAttribute()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=B88E3F&color=fff&size=300';
    }

    /**
     * Get the average rating from reviews.
     */
    public function getAverageRatingAttribute()
    {
        // Try to get from relationship if not already loaded
        if ($this->relationLoaded('approvedReviews')) {
            return $this->approvedReviews->avg('rating') ?? 0;
        }
        
        // Otherwise use the stored rating
        return $this->rating ?? 0;
    }

    /**
     * Get the total number of reviews.
     */
    public function getReviewsCountAttribute()
    {
        // Try to get from relationship if not already loaded
        if ($this->relationLoaded('approvedReviews')) {
            return $this->approvedReviews->count();
        }
        
        // This would need a reviews_count column to be efficient
        return $this->reviews()->where('is_approved', true)->count();
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
            return [
                'label' => 'In Stock', 
                'class' => 'text-success',
                'icon' => 'ri-checkbox-circle-line'
            ];
        } elseif ($this->stock > 0) {
            return [
                'label' => 'Low Stock', 
                'class' => 'text-warning',
                'icon' => 'ri-error-warning-line'
            ];
        }
        return [
            'label' => 'Out of Stock', 
            'class' => 'text-danger',
            'icon' => 'ri-close-circle-line'
        ];
    }

    /**
     * Get related products from same category.
     */
    public function relatedProducts($limit = 4)
    {
        return self::where('category_id', $this->category_id)
                   ->where('id', '!=', $this->id)
                   ->where('is_active', true)
                   ->where('stock', '>', 0)
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
     * Increase stock (for cancellations/returns).
     */
    public function increaseStock($quantity)
    {
        $this->increment('stock', $quantity);
        $this->decrement('sold_count', $quantity);
    }

    /**
     * Check if product has sufficient stock.
     */
    public function hasStock($quantity = 1)
    {
        return $this->stock >= $quantity;
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

    /**
     * Get the WhatsApp share link.
     */
    public function getWhatsAppShareLinkAttribute()
    {
        $text = "Check out this product on Vendora:\n\n" . $this->name . "\n" . $this->formatted_price . "\n\n" . $this->getUrlAttribute();
        return 'https://wa.me/?text=' . urlencode($text);
    }

    /**
     * Get the Telegram share link.
     */
    public function getTelegramShareLinkAttribute()
    {
        $text = "Check out this product on Vendora:\n\n" . $this->name . "\n" . $this->formatted_price;
        return 'https://t.me/share/url?url=' . urlencode($this->getUrlAttribute()) . '&text=' . urlencode($text);
    }

    /**
     * Get the Facebook share link.
     */
    public function getFacebookShareLinkAttribute()
    {
        return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($this->getUrlAttribute());
    }

    /**
     * Get the Twitter share link.
     */
    public function getTwitterShareLinkAttribute()
    {
        $text = "Check out " . $this->name . " on Vendora";
        return 'https://twitter.com/intent/tweet?text=' . urlencode($text) . '&url=' . urlencode($this->getUrlAttribute());
    }
}