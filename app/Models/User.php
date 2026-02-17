<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        'store_views',
        'location',
        'latitude',
        'longitude',
        'facebook_url',
        'instagram_url',
        'telegram_url',
        'twitter_url',
        'business_hours',
        'referral_code',
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
        'store_views' => 'integer',
        'business_hours' => 'array',
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
        'country' => 'Ethiopia',
        'store_views' => 0,
    ];

    /**
     * Get the products for the vendor.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    /**
     * Get active products for the vendor.
     */
    public function activeProducts()
    {
        return $this->hasMany(Product::class, 'vendor_id')->where('is_active', true);
    }

    /**
     * Get the orders for the user (as customer).
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * Get the orders for the vendor (through products).
     */
    public function vendorOrders()
    {
        return $this->hasManyThrough(Order::class, Product::class, 'vendor_id', 'id', 'id', 'order_id');
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
     * The categories that belong to the vendor.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_vendor', 'user_id', 'category_id')
                    ->withTimestamps();
    }

    /**
     * Get the reviews received by this vendor.
     */
    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'vendor_id');
    }

    /**
     * Get the reviews written by this user.
     */
    public function writtenReviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    /**
     * Get the messages sent by the user.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get the messages received by the user.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Get the notifications for the user.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    /**
     * Get unread notifications for the user.
     */
    public function unreadNotifications()
    {
        return $this->hasMany(Notification::class, 'user_id')->where('is_read', false);
    }

    /**
     * Get unread messages for the user.
     */
    public function unreadMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id')->where('is_read', false);
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
     * Get the avatar URL with fallback.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::url($this->avatar);
        }
        
        $name = $this->business_name ?? $this->name ?? 'User';
        $initials = '';
        $words = explode(' ', $name);
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($initials ?: 'U') . '&background=B88E3F&color=fff&size=200';
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
     * Get the location string.
     */
    public function getLocationStringAttribute(): string
    {
        $parts = [];
        if ($this->city) $parts[] = $this->city;
        if ($this->state) $parts[] = $this->state;
        if ($this->country && $this->country !== 'Ethiopia') $parts[] = $this->country;
        
        return implode(', ', $parts) ?: 'Ethiopia';
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
     * Scope a query to only include admins.
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
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
        $query->where(function($q) use ($city) {
            $q->where('city', 'like', "%{$city}%")
              ->orWhere('location', 'like', "%{$city}%");
        });
        
        if ($state) {
            $query->where(function($q) use ($state) {
                $q->where('state', 'like', "%{$state}%")
                  ->orWhere('location', 'like', "%{$state}%");
            });
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
     * Scope a query to search vendors by name or description.
     */
    public function scopeSearch($query, string $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('business_name', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('category', 'like', "%{$term}%")
              ->orWhere('city', 'like', "%{$term}%")
              ->orWhere('state', 'like', "%{$term}%");
        });
    }

    /**
     * Scope a query to order by rating.
     */
    public function scopePopular($query)
    {
        return $query->orderBy('rating', 'desc')->orderBy('total_reviews', 'desc');
    }

    /**
     * Scope a query to order by newest.
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
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
            $html .= '<i class="ri-star-fill" style="color: #f59e0b;"></i>';
        }
        
        if ($halfStar) {
            $html .= '<i class="ri-star-half-fill" style="color: #f59e0b;"></i>';
        }
        
        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '<i class="ri-star-line" style="color: #f59e0b;"></i>';
        }
        
        return $html;
    }

    /**
     * Get the rating as a simple star count.
     */
    public function getRatingDisplayAttribute(): string
    {
        return number_format($this->rating, 1) . ' (' . $this->total_reviews . ' ' . Str::plural('review', $this->total_reviews) . ')';
    }

    /**
     * Route notifications to the mail channel.
     */
    public function routeNotificationForMail(): string
    {
        return $this->email;
    }

    /**
     * Route notifications for SMS (if using).
     */
    public function routeNotificationForSms()
    {
        return $this->phone;
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

    /**
     * Increment store views.
     */
    public function incrementStoreViews(): void
    {
        $this->increment('store_views');
    }

    /**
     * Check if user has a referral code.
     */
    public function hasReferralCode(): bool
    {
        return !is_null($this->referral_code);
    }

    /**
     * Generate a unique referral code.
     */
    public function generateReferralCode(): string
    {
        $code = 'VENDORA' . strtoupper(substr(md5($this->id . time()), 0, 6));
        $this->referral_code = $code;
        $this->save();
        
        return $code;
    }

    /**
     * Get referred users.
     */
    public function referrals()
    {
        // This would need a referrals table
        return $this->hasMany(User::class, 'referred_by');
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Generate referral code for new vendors
        static::created(function ($user) {
            if ($user->isVendor() && !$user->referral_code) {
                $user->generateReferralCode();
            }
        });
    }
}