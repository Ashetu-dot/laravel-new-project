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
}