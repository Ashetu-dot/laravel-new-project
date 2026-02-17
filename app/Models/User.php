<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'business_name',
        'category',
        'tax_id',
        'website',
        'description',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zip_code',
        'country',
        'avatar',
        'main_image',
        'sub_image_1',
        'sub_image_2',
        'products_count',
        'rating',
        'total_reviews',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'products_count' => 'integer',
        'rating' => 'decimal:2',
        'total_reviews' => 'integer',
    ];

    /**
     * The attributes that should have default values.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'role' => 'customer',
        'is_active' => true,
        'products_count' => 0,
        'rating' => 0,
        'total_reviews' => 0,
        'country' => 'USA',
    ];

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * Get the vendors that this user is following.
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'vendor_id')
                    ->withTimestamps();
    }

    /**
     * Get the users who are following this vendor.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'vendor_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Check if the user is a vendor.
     */
    public function isVendor(): bool
    {
        return $this->role === 'vendor';
    }

    /**
     * Check if the user is a customer.
     */
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }



    /**
 * The categories that belong to the vendor.
 */
public function categories()
{
    return $this->belongsToMany(Category::class, 'category_vendor', 'user_id', 'category_id');
}






    /**
     * Get the avatar URL with fallback.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::url($this->avatar);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->business_name ?? $this->name ?? 'User') . '&background=B88E3F&color=fff';
    }

    /**
     * Get the full address attribute.
     */
    public function getFullAddressAttribute(): string
    {
        $parts = [];
        if ($this->address_line1) $parts[] = $this->address_line1;
        if ($this->address_line2) $parts[] = $this->address_line2;
        
        $cityState = [];
        if ($this->city) $cityState[] = $this->city;
        if ($this->state) $cityState[] = $this->state;
        if ($this->zip_code) $cityState[] = $this->zip_code;
        
        if (!empty($cityState)) $parts[] = implode(', ', $cityState);
        if ($this->country) $parts[] = $this->country;
        
        return implode(', ', $parts);
    }

    /**
     * Check if the user is following a specific vendor.
     */
    public function isFollowing(User $vendor): bool
    {
        return $this->following()
            ->where('vendor_id', $vendor->id)
            ->exists();
    }

    /**
     * Get the count of vendors this user is following.
     */
    public function getFollowingCountAttribute(): int
    {
        return $this->following()->count();
    }

    /**
     * Get the count of followers for this vendor.
     */
    public function getFollowersCountAttribute(): int
    {
        return $this->followers()->count();
    }

    /**
     * Scope a query to only include vendors.
     */
    public function scopeVendors($query)
    {
        return $query->where('role', 'vendor');
    }

    /**
     * Scope a query to only include customers.
     */
    public function scopeCustomers($query)
    {
        return $query->where('role', 'customer');
    }

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter vendors by category.
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to filter vendors by location.
     */
    public function scopeByLocation($query, string $city, string $state = null)
    {
        $query->where('city', 'like', "%{$city}%");
        
        if ($state) {
            $query->where('state', 'like', "%{$state}%");
        }
        
        return $query;
    }

    /**
     * Scope a query to filter vendors by rating.
     */
    public function scopeMinRating($query, float $rating)
    {
        return $query->where('rating', '>=', $rating);
    }

    /**
     * Get the vendor's rating as stars HTML.
     */
    public function getRatingStarsAttribute(): string
    {
        $fullStars = floor($this->rating);
        $halfStar = ($this->rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
        
        $html = '';
        
        for ($i = 0; $i < $fullStars; $i++) {
            $html .= '<i class="ri-star-fill" style="color: #B88E3F;"></i>';
        }
        
        if ($halfStar) {
            $html .= '<i class="ri-star-half-fill" style="color: #B88E3F;"></i>';
        }
        
        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '<i class="ri-star-line" style="color: #B88E3F;"></i>';
        }
        
        return $html;
    }

    /**
     * Route notifications to the mail channel.
     */
    public function routeNotificationForMail(): string
    {
        return $this->email;
    }

    /**
     * Get the vendor's dashboard link.
     */
    public function getDashboardLinkAttribute(): string
    {
        if ($this->isVendor()) {
            return route('vendor.dashboard');
        } elseif ($this->isCustomer()) {
            return route('customer.dashboard');
        } elseif ($this->isAdmin()) {
            return route('admin.dashboard');
        }
        
        return route('home');
    }

    /**
     * Mark the user as online.
     */
    public function markAsOnline(): void
    {
        $this->last_login_at = now();
        $this->save();
    }
}