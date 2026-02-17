<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'short_description',
        'vendor_id',
        'is_global',
        'parent_id',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_global' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The relationships that should be eager loaded by default.
     */
    protected $with = [];

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [
        'vendors_count',
        'short_description',
        'image_url',
        'path',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the vendor that owns the category.
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get active products for the category.
     */
    public function activeProducts()
    {
        return $this->hasMany(Product::class)->where('is_active', true);
    }

    /**
     * Get the products count for the category.
     */
    public function productsCount(): int
    {
        return $this->activeProducts()->count();
    }

    // /**
    //  * Get vendors through the category_vendor pivot table.
    //  */
    // public function vendors()
    // {
    //     return $this->belongsToMany(User::class, 'category_vendor', 'category_id', 'user_id')
    //                 ->where('role', 'vendor')
    //                 ->withTimestamps();
    // }





// /**
//  * Get vendors through the category_vendor pivot table.
//  */
// public function vendors()
// {
//     // Try different possible column names
//     $tableName = 'category_vendor';
    
//     // Check which columns exist and use the correct ones
//     if (Schema::hasColumn($tableName, 'category_id') && Schema::hasColumn($tableName, 'user_id')) {
//         return $this->belongsToMany(User::class, $tableName, 'category_id', 'user_id')
//                     ->where('role', 'vendor')
//                     ->withTimestamps();
//     } 
//     elseif (Schema::hasColumn($tableName, 'category_id') && Schema::hasColumn($tableName, 'vendor_id')) {
//         return $this->belongsToMany(User::class, $tableName, 'category_id', 'vendor_id')
//                     ->where('role', 'vendor')
//                     ->withTimestamps();
//     }
//     elseif (Schema::hasColumn($tableName, 'category_id') && Schema::hasColumn($tableName, 'users_id')) {
//         return $this->belongsToMany(User::class, $tableName, 'category_id', 'users_id')
//                     ->where('role', 'vendor')
//                     ->withTimestamps();
//     }
//     else {
//         // Default fallback - return empty relationship
//         return $this->belongsToMany(User::class, $tableName)
//                     ->where('role', 'vendor')
//                     ->withTimestamps();
//     }
// }



/**
 * Get vendors through the category_vendor pivot table.
 */
public function vendors()
{
    return $this->belongsToMany(User::class, 'category_vendor', 'category_id', 'user_id')
                ->where('role', 'vendor')
                ->withTimestamps();
}



    /**
     * Get active vendors for the category.
     */
    public function activeVendors()
    {
        return $this->vendors()->where('is_active', true);
    }

    /**
     * Get the vendors count for the category.
     */
    public function getVendorsCountAttribute(): int
    {
        return $this->vendors()->count();
    }

    /**
     * Get the parent category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get active child categories.
     */
    public function activeChildren()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('is_active', true);
    }

    /**
     * Get all descendants of the category.
     */
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    /**
     * Check if category has children.
     */
    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    /**
     * Get the full path of the category (for breadcrumbs).
     */
    public function getPathAttribute(): string
    {
        $path = [$this->name];
        $parent = $this->parent;
        
        while ($parent) {
            array_unshift($path, $parent->name);
            $parent = $parent->parent;
        }
        
        return implode(' > ', $path);
    }

    /**
     * Get the icon for the category (with fallback).
     */
    public function getIconAttribute($value): string
    {
        if ($value) {
            return $value;
        }

        // Default icons based on category name
        $icons = [
            'coffee' => 'ri-cup-line',
            'tea' => 'ri-cup-line',
            'food' => 'ri-restaurant-line',
            'restaurant' => 'ri-restaurant-line',
            'handicraft' => 'ri-palette-line',
            'craft' => 'ri-palette-line',
            'art' => 'ri-palette-line',
            'photography' => 'ri-camera-lens-line',
            'photo' => 'ri-camera-lens-line',
            'beauty' => 'ri-heart-pulse-line',
            'salon' => 'ri-heart-pulse-line',
            'spa' => 'ri-heart-pulse-line',
            'home' => 'ri-home-gear-line',
            'repair' => 'ri-tools-line',
            'automotive' => 'ri-car-washing-line',
            'car' => 'ri-car-washing-line',
            'tech' => 'ri-computer-line',
            'computer' => 'ri-computer-line',
            'phone' => 'ri-smartphone-line',
            'event' => 'ri-cake-3-line',
            'party' => 'ri-cake-3-line',
            'wedding' => 'ri-cake-3-line',
            'clothing' => 'ri-shirt-line',
            'fashion' => 'ri-shirt-line',
            'health' => 'ri-heart-pulse-line',
            'fitness' => 'ri-heart-pulse-line',
            'education' => 'ri-book-open-line',
            'training' => 'ri-book-open-line',
            'cleaning' => 'ri-brush-line',
            'laundry' => 'ri-brush-line',
            'electronics' => 'ri-device-line',
            'gadgets' => 'ri-device-line',
            'services' => 'ri-customer-service-2-line',
        ];

        $lowercaseName = strtolower($this->name);
        
        foreach ($icons as $key => $icon) {
            if (strpos($lowercaseName, $key) !== false) {
                return $icon;
            }
        }

        return 'ri-price-tag-3-line'; // Default icon
    }

    /**
     * Get the image URL attribute.
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        
        return null;
    }

    /**
     * Get the short description (excerpt).
     */
    public function getShortDescriptionAttribute(): string
    {
        if (!$this->description) {
            return "Find the best " . $this->name . " vendors in Jimma and across Ethiopia.";
        }
        
        return strlen($this->description) > 100 
            ? substr($this->description, 0, 100) . '...' 
            : $this->description;
    }

    /**
     * Get the vendors count in a specific location.
     */
    public function getVendorsCountInLocation(string $location = 'Jimma'): int
    {
        return $this->vendors()
                    ->where(function($q) use ($location) {
                        $q->where('city', 'LIKE', "%{$location}%")
                          ->orWhere('state', 'LIKE', "%{$location}%")
                          ->orWhere('location', 'LIKE', "%{$location}%");
                    })
                    ->count();
    }

    /**
     * Get the formatted created date.
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('M d, Y');
    }

    /**
     * Get the formatted updated date.
     */
    public function getFormattedUpdatedAtAttribute(): string
    {
        return $this->updated_at->format('M d, Y');
    }

    /**
     * Check if category is global.
     */
    public function isGlobal(): bool
    {
        return $this->is_global === true;
    }

    /**
     * Check if category is active.
     */
    public function isActive(): bool
    {
        return $this->is_active === true;
    }

    /**
     * Scope a query to only include global categories.
     */
    public function scopeGlobal($query)
    {
        return $query->where('is_global', true);
    }

    /**
     * Scope a query to only include vendor-specific categories.
     */
    public function scopeForVendor($query, $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    /**
     * Scope a query to only include active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include parent categories (no parent).
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope a query to only include child categories.
     */
    public function scopeChildren($query)
    {
        return $query->whereNotNull('parent_id');
    }

    /**
     * Scope a query to get popular categories (with most products).
     */
    public function scopePopular($query, $limit = 6)
    {
        return $query->withCount('products')
                     ->orderBy('products_count', 'desc')
                     ->limit($limit);
    }

    /**
     * Scope a query to get categories popular in a specific location.
     */
    public function scopePopularInLocation($query, $location, $limit = 3)
    {
        return $query->whereHas('products.vendor', function($q) use ($location) {
            $q->where(function($subQuery) use ($location) {
                $subQuery->where('city', 'LIKE', "%{$location}%")
                         ->orWhere('state', 'LIKE', "%{$location}%")
                         ->orWhere('location', 'LIKE', "%{$location}%");
            });
        })->withCount(['products' => function($q) use ($location) {
            $q->whereHas('vendor', function($vendorQuery) use ($location) {
                $vendorQuery->where(function($subQuery) use ($location) {
                    $subQuery->where('city', 'LIKE', "%{$location}%")
                             ->orWhere('state', 'LIKE', "%{$location}%")
                             ->orWhere('location', 'LIKE', "%{$location}%");
                });
            });
        }])->orderBy('products_count', 'desc')
          ->limit($limit);
    }

    /**
     * Scope a query to search categories by name.
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', "%{$term}%")
                     ->orWhere('description', 'LIKE', "%{$term}%");
    }

    /**
     * Get the tree structure of categories.
     */
    public static function getTree()
    {
        return self::with('children')
                   ->whereNull('parent_id')
                   ->orderBy('name')
                   ->get();
    }

    /**
     * Get the options for select dropdown.
     */
    public static function getOptions()
    {
        return self::where('is_active', true)
                   ->orderBy('name')
                   ->pluck('name', 'id');
    }

    /**
     * Get the hierarchical options for select dropdown.
     */
    public static function getHierarchicalOptions($prefix = '—', $parentId = null)
    {
        $options = [];
        $categories = self::where('parent_id', $parentId)
                         ->where('is_active', true)
                         ->orderBy('name')
                         ->get();

        foreach ($categories as $category) {
            $options[$category->id] = $category->name;
            $children = self::getHierarchicalOptions($prefix . '—', $category->id);
            foreach ($children as $childId => $childName) {
                $options[$childId] = $prefix . ' ' . $childName;
            }
        }

        return $options;
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug if not provided
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
            
            // Ensure slug is unique
            $originalSlug = $category->slug;
            $counter = 1;
            
            while (static::where('slug', $category->slug)->exists()) {
                $category->slug = $originalSlug . '-' . $counter++;
            }
        });

        // Update slug when name changes
        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $newSlug = Str::slug($category->name);
                
                // Check if new slug is different and not already taken
                if ($newSlug !== $category->getOriginal('slug')) {
                    $originalSlug = $newSlug;
                    $counter = 1;
                    
                    while (static::where('slug', $newSlug)->where('id', '!=', $category->id)->exists()) {
                        $newSlug = $originalSlug . '-' . $counter++;
                    }
                    
                    $category->slug = $newSlug;
                }
            }
        });

        // Clean up relationships when deleting
        static::deleting(function ($category) {
            // Update child categories to have no parent
            if ($category->children()->exists()) {
                $category->children()->update(['parent_id' => null]);
            }
            
            // Detach all vendors
            $category->vendors()->detach();
            
            // Set category_id to null for products
            if ($category->products()->exists()) {
                $category->products()->update(['category_id' => null]);
            }
        });
    }
}