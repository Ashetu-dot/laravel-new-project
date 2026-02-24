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
        'phone',
        'city',
        'state',
        'country',
        'address_line1',
       'address_line2',
        'zip_code',
        'business_name',
        'category',
        'tax_id',
        'website',
        'description',
        'avatar',
        'main_image',
        'sub_image_1',
        'sub_image_2',
        'is_active',
       'last_login_at',
        'referral_code',
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
        'theme_preference',
        'email_verified_at',
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
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
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
        'theme_preference' => 'light',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'avatar_url',
        'full_address',
        'location_string',
        'rating_stars',
        'rating_display',
        'dashboard_link',
        'following_count',
        'followers_count',
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
     * Get the customer profile for the user.
     */
    public function customerProfile()
    {
        return $this->hasOne(CustomerProfile::class);
    }

    /**
     * Get the vendor profile for the user.
     */
    public function vendorProfile()
    {
        return $this->hasOne(VendorProfile::class);
    }

    /**
     * Get the search history for the user.
     */
    public function searchHistory()
    {
        return $this->hasMany(SearchHistory::class)->latest();
    }

    /**
     * Get the recent searches for the user.
     */
    public function recentSearches()
    {
        return $this->hasMany(SearchHistory::class)
                    ->latest()
                    ->limit(5);
    }

    /**
     * Get the saved vendors for the user.
     */
    public function savedVendors()
    {
        return $this->belongsToMany(User::class, 'saved_vendors', 'user_id', 'vendor_id')
                    ->withTimestamps();
    }

    /**
     * Get the recently viewed vendors for the user.
     */
    public function recentlyViewedVendors()
    {
        return $this->belongsToMany(User::class, 'recently_viewed', 'user_id', 'vendor_id')
                    ->withPivot('created_at', 'view_count')
                    ->orderBy('pivot_created_at', 'desc');
    }

    /**
     * Get the cart items for the user.
     */
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the wishlist items for the user.
     */
    public function wishlistItems()
    {
        return $this->belongsToMany(Product::class, 'wishlists')
                    ->withTimestamps();
    }

    /**
     * Get the user's activity logs.
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Get the user's login history.
     */
    public function loginHistory()
    {
        return $this->hasMany(LoginHistory::class);
    }

    /**
     * Get the user's social accounts.
     */
    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * Get the user's verification requests (if vendor).
     */
    public function verificationRequests()
    {
        return $this->hasMany(VerificationRequest::class);
    }

    /**
     * Get the user's support tickets.
     */
    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    /**
     * Get the user's coupons.
     */
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'user_coupons')
                    ->withPivot('used_at', 'order_id')
                    ->withTimestamps();
    }

    /**
     * Get the user's favorite products.
     */
    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorites')
                    ->withTimestamps();
    }

    /**
     * Get the user's reports (if vendor).
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'vendor_id');
    }

    /**
     * Get the user's transactions.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the user's referrals.
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
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
     * Check if the user is verified.
     */
    public function isVerified(): bool
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Check if the user is active.
     */
    public function isActive(): bool
    {
        return $this->is_active === true;
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
     * Check if the user has saved a specific vendor.
     */
    public function hasSavedVendor(User $vendor): bool
    {
        return $this->savedVendors()
            ->where('vendor_id', $vendor->id)
            ->exists();
    }

    /**
     * Check if the user has favorited a specific product.
     */
    public function hasFavoritedProduct(Product $product): bool
    {
        return $this->favoriteProducts()
            ->where('product_id', $product->id)
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
     * Get user's theme preference.
     */
    public function getThemeAttribute(): string
    {
        return $this->theme_preference ?? session('theme', 'light');
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
     * Scope a query to only include verified users.
     */
    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
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
        return $query->orderBy('rating', 'desc')
                     ->orderBy('total_reviews', 'desc')
                     ->orderBy('products_count', 'desc');
    }

    /**
     * Scope a query to order by newest.
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to order by most followed.
     */
    public function scopeMostFollowed($query)
    {
        return $query->withCount('followers')
                     ->orderBy('followers_count', 'desc');
    }

    /**
     * Scope a query to filter by referral code.
     */
    public function scopeByReferral($query, string $code)
    {
        return $query->where('referral_code', $code);
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
     * Route notifications for database channel.
     */
    public function routeNotificationForDatabase()
    {
        return $this->notifications();
    }

    /**
     * Mark the user as online.
     */
    public function markAsOnline(): void
    {
        $this->last_login_at = now();
        $this->save();

        // Log login history
        if (app()->runningInConsole() === false) {
            $this->loginHistory()->create([
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'login_at' => now(),
            ]);
        }
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
        $code = 'VENDORA' . strtoupper(substr(md5($this->id . uniqid()), 0, 6));

        // Ensure uniqueness
        while (self::where('referral_code', $code)->exists()) {
            $code = 'VENDORA' . strtoupper(substr(md5($this->id . uniqid()), 0, 6));
        }

        $this->referral_code = $code;
        $this->save();

        return $code;
    }

    /**
     * Get referred users count.
     */
    public function getReferralsCountAttribute(): int
    {
        return $this->referrals()->count();
    }

    /**
     * Add a product to wishlist.
     */
    public function addToWishlist(Product $product): void
    {
        if (!$this->wishlistItems()->where('product_id', $product->id)->exists()) {
            $this->wishlistItems()->attach($product->id);
        }
    }

    /**
     * Remove a product from wishlist.
     */
    public function removeFromWishlist(Product $product): void
    {
        $this->wishlistItems()->detach($product->id);
    }

    /**
     * Add a vendor to saved vendors.
     */
    public function saveVendor(User $vendor): void
    {
        if (!$this->savedVendors()->where('vendor_id', $vendor->id)->exists()) {
            $this->savedVendors()->attach($vendor->id);
        }
    }

    /**
     * Remove a vendor from saved vendors.
     */
    public function unsaveVendor(User $vendor): void
    {
        $this->savedVendors()->detach($vendor->id);
    }

    /**
     * Record a vendor view.
     */
    public function recordVendorView(User $vendor): void
    {
        $existing = $this->recentlyViewedVendors()
                        ->where('vendor_id', $vendor->id)
                        ->first();

        if ($existing) {
            $this->recentlyViewedVendors()
                 ->updateExistingPivot($vendor->id, [
                     'created_at' => now(),
                     'view_count' => $existing->pivot->view_count + 1
                 ]);
        } else {
            $this->recentlyViewedVendors()
                 ->attach($vendor->id, ['view_count' => 1]);
        }

        // Keep only last 10 viewed vendors
        $count = $this->recentlyViewedVendors()->count();
        if ($count > 10) {
            $oldest = $this->recentlyViewedVendors()
                          ->orderBy('pivot_created_at', 'asc')
                          ->limit($count - 10)
                          ->get();

            foreach ($oldest as $old) {
                $this->recentlyViewedVendors()->detach($old->id);
            }
        }
    }

    /**
     * Clear search history.
     */
    public function clearSearchHistory(): void
    {
        $this->searchHistory()->delete();
    }

    /**
     * Get recent searches.
     */
    public function getRecentSearchesAttribute()
    {
        return $this->searchHistory()
                    ->latest()
                    ->limit(5)
                    ->get();
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

        // Update timestamp on related models when user is updated
        static::updated(function ($user) {
            if ($user->isDirty('rating') && $user->isVendor()) {
                // Update any vendor rating caches
                \Cache::forget('vendor_rating_' . $user->id);
            }
        });

        // Clean up related data when user is deleted
        static::deleting(function ($user) {
            // Delete related records
            $user->searchHistory()->delete();
            $user->activityLogs()->delete();
            $user->notifications()->delete();
            $user->cartItems()->delete();
            $user->loginHistory()->delete();

            // Detach relationships
            $user->following()->detach();
            $user->followers()->detach();
            $user->savedVendors()->detach();
            $user->recentlyViewedVendors()->detach();
            $user->wishlistItems()->detach();
            $user->favoriteProducts()->detach();
            $user->categories()->detach();
        });
    }
}