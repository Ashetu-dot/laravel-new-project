<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'business_name',
        'email',
        'password',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zip_code',
        'country',
        'category',
        'category_id',
        'description',
        'image',
        'verified',
        'delivery_time',
        'min_order',
        'response_rate',
        'tax_id',
        'website',
        'role',
    ];

    protected $casts = [
        'verified' => 'boolean',
    ];

    /**
     * Get the category that owns the vendor.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the products for the vendor.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    /**
     * Get the reviews for the vendor through their products.
     */
    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Product::class, 'vendor_id', 'product_id', 'id', 'id');
    }

    /**
     * Get the orders for the vendor.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'vendor_id');
    }

    /**
     * Get the followers for the vendor.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'vendor_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Scope a query to only include verified vendors.
     */
    public function scopeVerified($query)
    {
        return $query->where('verified', true);
    }

    /**
     * Scope a query to only include vendors in a specific category.
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to only include vendors in a specific city.
     */
    public function scopeInCity($query, $city)
    {
        return $query->where('city', $city);
    }
}
