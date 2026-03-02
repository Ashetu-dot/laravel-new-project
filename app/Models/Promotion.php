<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'max_discount',
        'min_purchase',
        'start_date',
        'end_date',
        'usage_limit_per_user',
        'total_usage_limit',
        'used_count',
        'product_scope',
        'description',
        'terms_conditions',
        'banner',
        'is_active',
        'created_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the products that belong to this promotion.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_products');
    }

    /**
     * Get the categories that belong to this promotion.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'promotion_categories');
    }

    /**
     * Get the usages of this promotion.
     */
    public function usages()
    {
        return $this->hasMany(PromotionUsage::class);
    }

    /**
     * Get the user who created this promotion.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Check if the promotion is currently valid.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();

        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }

        if ($this->total_usage_limit && $this->used_count >= $this->total_usage_limit) {
            return false;
        }

        return true;
    }

    /**
     * Check if a user can use this promotion.
     *
     * @param int $userId
     * @return bool
     */
    public function canUserUse(int $userId): bool
    {
        if (!$this->isValid()) {
            return false;
        }

        if ($this->usage_limit_per_user) {
            $userUsageCount = $this->usages()
                ->where('user_id', $userId)
                ->count();

            if ($userUsageCount >= $this->usage_limit_per_user) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if this promotion applies to a specific product.
     *
     * @param int $productId
     * @return bool
     */
    public function appliesToProduct(int $productId): bool
    {
        if ($this->product_scope === 'all') {
            return true;
        }

        if ($this->product_scope === 'selected') {
            return $this->products()->where('product_id', $productId)->exists();
        }

        if ($this->product_scope === 'categories') {
            $product = Product::find($productId);
            if (!$product) {
                return false;
            }
            return $this->categories()->where('category_id', $product->category_id)->exists();
        }

        return false;
    }

    /**
     * Calculate discount amount for a given subtotal.
     *
     * @param float $subtotal
     * @return float
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === 'percentage') {
            $discount = ($subtotal * $this->value) / 100;
            
            if ($this->max_discount && $discount > $this->max_discount) {
                $discount = $this->max_discount;
            }
            
            return round($discount, 2);
        }

        if ($this->type === 'fixed') {
            return min($this->value, $subtotal);
        }

        if ($this->type === 'free_shipping') {
            // This would be handled separately in shipping calculation
            return 0;
        }

        // BOGO type would need more complex logic
        return 0;
    }

    /**
     * Scope a query to only include active promotions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            })
            ->where(function($q) {
                $q->whereNull('total_usage_limit')
                  ->orWhere('used_count', '<', \DB::raw('total_usage_limit'));
            });
    }

    /**
     * Scope a query to only include promotions for a specific product.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $productId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForProduct($query, int $productId)
    {
        return $query->where(function($q) use ($productId) {
            $q->where('product_scope', 'all')
              ->orWhere(function($q2) use ($productId) {
                  $q2->where('product_scope', 'selected')
                      ->whereHas('products', function($pq) use ($productId) {
                          $pq->where('product_id', $productId);
                      });
              })
              ->orWhere(function($q2) use ($productId) {
                  $product = Product::find($productId);
                  if ($product) {
                      $q2->where('product_scope', 'categories')
                          ->whereHas('categories', function($cq) use ($product) {
                              $cq->where('category_id', $product->category_id);
                          });
                  }
              });
        });
    }
}