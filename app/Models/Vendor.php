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
        'is_verified',
        'delivery_time',
        'min_order',
        'response_rate',
        'tax_id',
        'website',
        'role',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
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

    /**
     * Get the banner image attribute.
     */
    public function getBannerImageAttribute()
    {
        return $this->main_image ?? $this->sub_image_1 ?? asset('images/default-banner.jpg');
    }

    /**
     * Get the weekday hours attribute.
     */
    public function getWeekdayHoursAttribute()
    {
        $hours = $this->business_hours ? json_decode($this->business_hours, true) : [];
        return $hours['weekday'] ?? $hours['monday'] ?? '7:00–20:00';
    }

    /**
     * Get the saturday hours attribute.
     */
    public function getSaturdayHoursAttribute()
    {
        $hours = $this->business_hours ? json_decode($this->business_hours, true) : [];
        return $hours['saturday'] ?? '8:00–21:00';
    }

    /**
     * Get the sunday hours attribute.
     */
    public function getSundayHoursAttribute()
    {
        $hours = $this->business_hours ? json_decode($this->business_hours, true) : [];
        return $hours['sunday'] ?? '8:00–18:00';
    }

    /**
     * Get the closing time attribute.
     */
    public function getClosingTimeAttribute()
    {
        $weekday = $this->weekday_hours;
        if (preg_match('/–(\d+:\d+)/', $weekday, $matches)) {
            return $matches[1];
        }
        return '20:00';
    }

    /**
     * Get the tags attribute.
     */
    public function getTagsAttribute()
    {
        // Get tags from products
        return $this->products->pluck('tags')->flatten()->unique()->filter()->values()->toArray();
    }
}