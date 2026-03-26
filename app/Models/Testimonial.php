<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_name',
        'author_role',
        'author_image',
        'content',
        'rating',
        'is_active',
        'sort_order',
        'vendor_id',
        'product_id',
        'user_id',
        'verified',
        'featured',
        'response',
        'response_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'verified' => 'boolean',
        'featured' => 'boolean',
        'sort_order' => 'integer',
        'rating' => 'decimal:1',
        'response_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'avatar_url',
        'formatted_date',
        'rating_stars',
        'excerpt',
        'author_initials',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($testimonial) {
            if (empty($testimonial->sort_order)) {
                $testimonial->sort_order = static::max('sort_order') + 1;
            }
        });
    }

    /**
     * Get the vendor that this testimonial belongs to.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the product that this testimonial belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who wrote this testimonial.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include active testimonials.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include verified testimonials.
     */
    public function scopeVerified($query)
    {
        return $query->where('verified', true);
    }

    /**
     * Scope a query to only include featured testimonials.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope a query to only include testimonials with a minimum rating.
     */
    public function scopeMinRating($query, $rating)
    {
        return $query->where('rating', '>=', $rating);
    }

    /**
     * Scope a query to order by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query for vendor testimonials.
     */
    public function scopeForVendor($query, $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    /**
     * Scope a query for product testimonials.
     */
    public function scopeForProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    /**
     * Get the avatar URL attribute.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->author_image) {
            return $this->getInitialsAvatar();
        }

        // If it's a full URL, return as is
        if (filter_var($this->author_image, FILTER_VALIDATE_URL)) {
            return $this->author_image;
        }

        // If it's a local storage path
        if (Storage::disk('public')->exists($this->author_image)) {
            return Storage::disk('public')->url($this->author_image);
        }

        return $this->getInitialsAvatar();
    }

    /**
     * Get initials avatar from UI Avatars.
     */
    private function getInitialsAvatar(): string
    {
        $initials = $this->author_initials;
        $backgroundColor = $this->getRandomColor($this->author_name);

        return "https://ui-avatars.com/api/?name={$initials}&background={$backgroundColor}&color=fff&size=96&bold=true&length=2";
    }

    /**
     * Get random color based on name.
     */
    private function getRandomColor(string $name): string
    {
        $colors = [
            'B88E3F', // Gold
            '4A90E2', // Blue
            'E34D4D', // Red
            '50C878', // Green
            '9B59B6', // Purple
            'F39C12', // Orange
            '1ABC9C', // Turquoise
            'E67E22', // Carrot
            '3498DB', // Peter River
            'E74C3C', // Alizarin
        ];

        $index = abs(crc32($name)) % count($colors);
        return $colors[$index];
    }

    /**
     * Get the author initials.
     */
    public function getAuthorInitialsAttribute(): string
    {
        $words = explode(' ', trim($this->author_name));
        $initials = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }

        // Limit to 2 characters
        return substr($initials, 0, 2);
    }

    /**
     * Get the formatted date attribute.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('M d, Y');
    }

    /**
     * Get the formatted date for display.
     */
    public function getFormattedDateLongAttribute(): string
    {
        return $this->created_at->format('F d, Y');
    }

    /**
     * Get the relative date (e.g., "2 days ago").
     */
    public function getRelativeDateAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get the rating stars as HTML.
     */
    public function getRatingStarsAttribute(): string
    {
        if (!$this->rating) {
            return '';
        }

        $fullStars = floor($this->rating);
        $halfStar = ($this->rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

        $stars = str_repeat('★', $fullStars);
        $stars .= $halfStar ? '½' : '';
        $stars .= str_repeat('☆', $emptyStars);

        return $stars;
    }

    /**
     * Get the rating as a percentage.
     */
    public function getRatingPercentageAttribute(): float
    {
        if (!$this->rating) {
            return 0;
        }

        return ($this->rating / 5) * 100;
    }

    /**
     * Get the excerpt of content.
     */
    public function getExcerptAttribute(): string
    {
        return $this->excerpt(120);
    }

    /**
     * Get excerpt of content with custom length.
     */
    public function excerpt(int $length = 100): string
    {
        return Str::limit($this->content, $length);
    }

    /**
     * Check if testimonial has a response.
     */
    public function getHasResponseAttribute(): bool
    {
        return !empty($this->response);
    }

    /**
     * Get the formatted response.
     */
    public function getFormattedResponseAttribute(): ?string
    {
        if (!$this->response) {
            return null;
        }

        return nl2br(e($this->response));
    }

    /**
     * Get the response date formatted.
     */
    public function getResponseDateFormattedAttribute(): ?string
    {
        return $this->response_date?->format('M d, Y');
    }

    /**
     * Determine if testimonial is recently added.
     */
    public function getIsRecentAttribute(): bool
    {
        return $this->created_at->diffInDays(now()) <= 30;
    }

    /**
     * Get the rating as a numeric value.
     */
    public function getRatingValueAttribute(): float
    {
        return (float) $this->rating;
    }

    /**
     * Get the word count of the content.
     */
    public function getWordCountAttribute(): int
    {
        return str_word_count($this->content);
    }

    /**
     * Get the reading time in minutes.
     */
    public function getReadingTimeAttribute(): int
    {
        $wordsPerMinute = 200;
        $wordCount = $this->word_count;

        return max(1, ceil($wordCount / $wordsPerMinute));
    }

    /**
     * Get the testimonial status badge.
     */
    public function getStatusBadgeAttribute(): string
    {
        if (!$this->is_active) {
            return '<span class="badge badge-danger">Inactive</span>';
        }

        if ($this->featured) {
            return '<span class="badge badge-warning">Featured</span>';
        }

        if (!$this->verified) {
            return '<span class="badge badge-info">Pending Verification</span>';
        }

        return '<span class="badge badge-success">Active</span>';
    }

    /**
     * Get the testimonial data for JSON-LD structured data.
     */
    public function getStructuredDataAttribute(): array
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Review',
            'author' => [
                '@type' => 'Person',
                'name' => $this->author_name,
            ],
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => $this->rating,
                'bestRating' => '5',
            ],
            'reviewBody' => $this->content,
            'datePublished' => $this->created_at->toIso8601String(),
        ];

        if ($this->vendor) {
            $data['itemReviewed'] = [
                '@type' => 'LocalBusiness',
                'name' => $this->vendor->name,
            ];
        }

        if ($this->product) {
            $data['itemReviewed'] = [
                '@type' => 'Product',
                'name' => $this->product->name,
            ];
        }

        return $data;
    }

    /**
     * Verify the testimonial.
     */
    public function verify(): bool
    {
        return $this->update(['verified' => true]);
    }

    /**
     * Unverify the testimonial.
     */
    public function unverify(): bool
    {
        return $this->update(['verified' => false]);
    }

    /**
     * Feature the testimonial.
     */
    public function feature(): bool
    {
        return $this->update(['featured' => true]);
    }

    /**
     * Unfeature the testimonial.
     */
    public function unfeature(): bool
    {
        return $this->update(['featured' => false]);
    }

    /**
     * Add a response to the testimonial.
     */
    public function addResponse(string $response): bool
    {
        return $this->update([
            'response' => $response,
            'response_date' => now(),
        ]);
    }

    /**
     * Delete the response.
     */
    public function deleteResponse(): bool
    {
        return $this->update([
            'response' => null,
            'response_date' => null,
        ]);
    }

    /**
     * Get the average rating for a vendor.
     */
    public static function getAverageRatingForVendor($vendorId): float
    {
        return static::where('vendor_id', $vendorId)
            ->where('is_active', true)
            ->whereNotNull('rating')
            ->avg('rating') ?? 0;
    }

    /**
     * Get the total number of testimonials for a vendor.
     */
    public static function getTotalForVendor($vendorId): int
    {
        return static::where('vendor_id', $vendorId)
            ->where('is_active', true)
            ->count();
    }

    /**
     * Get rating distribution for a vendor.
     */
    public static function getRatingDistribution($vendorId): array
    {
        $distribution = [];

        for ($i = 5; $i >= 1; $i--) {
            $distribution[$i] = static::where('vendor_id', $vendorId)
                ->where('is_active', true)
                ->where('rating', '>=', $i)
                ->where('rating', '<', $i + 1)
                ->count();
        }

        return $distribution;
    }
}
