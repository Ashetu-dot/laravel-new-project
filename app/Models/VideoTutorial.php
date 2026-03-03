<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VideoTutorial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'youtube_id',
        'vimeo_id',
        'thumbnail',
        'duration',
        'category',
        'tags',
        'sort_order',
        'is_featured',
        'is_published',
        'views_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'duration' => 'integer',
        'sort_order' => 'integer',
        'views_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_featured' => false,
        'is_published' => true,
        'views_count' => 0,
        'sort_order' => 0,
        'category' => 'general',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($video) {
            if (empty($video->slug)) {
                $video->slug = Str::slug($video->title);
            }
        });

        static::updating(function ($video) {
            if ($video->isDirty('title') && !$video->isDirty('slug')) {
                $video->slug = Str::slug($video->title);
            }
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope a query to only include published videos.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include featured videos.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by category.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to search videos.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('tags', 'like', "%{$search}%");
        });
    }

    /**
     * Get the video's URL based on platform.
     *
     * @return string|null
     */
    public function getVideoUrlAttribute()
    {
        if ($this->youtube_id) {
            return "https://www.youtube.com/watch?v={$this->youtube_id}";
        } elseif ($this->vimeo_id) {
            return "https://vimeo.com/{$this->vimeo_id}";
        }
        
        return null;
    }

    /**
     * Get the embed URL based on platform.
     *
     * @return string|null
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->youtube_id) {
            return "https://www.youtube.com/embed/{$this->youtube_id}";
        } elseif ($this->vimeo_id) {
            return "https://player.vimeo.com/video/{$this->vimeo_id}";
        }
        
        return null;
    }

    /**
     * Get the thumbnail URL.
     *
     * @return string|null
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset("storage/{$this->thumbnail}");
        } elseif ($this->youtube_id) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
        }
        
        return null;
    }

    /**
     * Get formatted duration.
     *
     * @return string
     */
    public function getFormattedDurationAttribute()
    {
        if (!$this->duration) {
            return '00:00';
        }
        
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;
        
        return sprintf('%d:%02d', $minutes, $seconds);
    }

    /**
     * Get related videos based on category or tags.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedVideos($limit = 4)
    {
        return self::where('is_published', true)
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->where('category', $this->category)
                    ->orWhereJsonContains('tags', $this->tags);
            })
            ->orderBy('views_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Increment views count.
     *
     * @return bool
     */
    public function incrementViews()
    {
        $this->increment('views_count');
        return true;
    }

    /**
     * Check if video is from YouTube.
     *
     * @return bool
     */
    public function isYouTube()
    {
        return !is_null($this->youtube_id);
    }

    /**
     * Check if video is from Vimeo.
     *
     * @return bool
     */
    public function isVimeo()
    {
        return !is_null($this->vimeo_id);
    }

    /**
     * Get the video provider name.
     *
     * @return string
     */
    public function getProviderAttribute()
    {
        if ($this->isYouTube()) {
            return 'YouTube';
        } elseif ($this->isVimeo()) {
            return 'Vimeo';
        }
        
        return 'Unknown';
    }

    /**
     * Toggle featured status.
     *
     * @return bool
     */
    public function toggleFeatured()
    {
        $this->is_featured = !$this->is_featured;
        return $this->save();
    }

    /**
     * Toggle published status.
     *
     * @return bool
     */
    public function togglePublished()
    {
        $this->is_published = !$this->is_published;
        return $this->save();
    }

    /**
     * Get all available categories with counts.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getCategoriesWithCounts()
    {
        return self::where('is_published', true)
            ->select('category')
            ->selectRaw('count(*) as total')
            ->groupBy('category')
            ->orderBy('category')
            ->get();
    }

    /**
     * Get popular videos.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getPopularVideos($limit = 6)
    {
        return self::where('is_published', true)
            ->orderBy('views_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get latest videos.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getLatestVideos($limit = 6)
    {
        return self::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get featured videos.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getFeaturedVideos($limit = 6)
    {
        return self::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get the total watch time in minutes for this video.
     *
     * @return int
     */
    public function getTotalWatchTimeAttribute()
    {
        return ($this->duration * $this->views_count) / 60;
    }

    /**
     * Check if the video has a thumbnail.
     *
     * @return bool
     */
    public function hasThumbnail()
    {
        return !is_null($this->thumbnail) || !is_null($this->youtube_id);
    }

    /**
     * Prepare tags as array.
     *
     * @param mixed $value
     * @return array
     */
    public function getTagsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        
        return $value ?? [];
    }

    /**
     * Set tags as JSON.
     *
     * @param mixed $value
     * @return void
     */
    public function setTagsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['tags'] = json_encode($value);
        } else {
            $this->attributes['tags'] = $value;
        }
    }
}