<?php
// app/Models/CustomerProfile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'preferences',
        'saved_vendors',
        'search_history',
    ];

    protected $casts = [
        'preferences' => 'array',
        'saved_vendors' => 'array',
        'search_history' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}