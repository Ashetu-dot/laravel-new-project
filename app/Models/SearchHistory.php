<?php
// app/Models/SearchHistory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'query',
        'filters',
        'results_count',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'filters' => 'array',
        'results_count' => 'integer',
    ];

    /**
     * Get the user that owns the search history.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include recent searches.
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to only include searches from the last 30 days.
     */
    public function scopeLast30Days($query)
    {
        return $query->where('created_at', '>=', now()->subDays(30));
    }
}