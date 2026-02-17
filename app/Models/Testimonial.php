<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'content',
        'avatar',
        'is_active',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active testimonials.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort_order.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Get the avatar URL attribute.
     *
     * @return string|null
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        
        // Generate avatar from name initials
        $name = $this->author_name;
        $words = explode(' ', $name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&background=B88E3F&color=fff&size=48';
    }

    /**
     * Get the formatted date attribute.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('M d, Y');
    }

    /**
     * Get the excerpt of content.
     *
     * @param  int  $length
     * @return string
     */
    public function excerpt($length = 100)
    {
        return strlen($this->content) > $length 
            ? substr($this->content, 0, $length) . '...' 
            : $this->content;
    }
}
