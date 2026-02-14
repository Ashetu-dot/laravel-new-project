<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'content',
        'is_read',
        'read_at',
        'parent_id'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }
}