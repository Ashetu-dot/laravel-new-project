<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

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
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the sender of the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the receiver of the message.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the replies to this message.
     */
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    /**
     * Get the parent message of this reply.
     */
    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    /**
     * Get the entire conversation thread for this message.
     */
    public function getConversationThread()
    {
        // If this is a reply, get the root message
        $rootMessage = $this->parent_id ? self::find($this->parent_id) : $this;
        
        if (!$rootMessage) {
            $rootMessage = $this;
        }
        
        // Get all messages in this thread (root + all replies)
        return self::with(['sender', 'receiver'])
            ->where('id', $rootMessage->id)
            ->orWhere('parent_id', $rootMessage->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Scope a query to only include unread messages.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope a query to only include messages for a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId);
    }

    /**
     * Scope a query to only include messages between two users.
     */
    public function scopeBetween($query, $userId1, $userId2)
    {
        return $query->where(function($q) use ($userId1, $userId2) {
            $q->where('sender_id', $userId1)->where('receiver_id', $userId2)
              ->orWhere('sender_id', $userId2)->where('receiver_id', $userId1);
        });
    }

    /**
     * Mark the message as read.
     */
    public function markAsRead()
    {
        $this->is_read = true;
        $this->read_at = now();
        $this->save();
    }

    /**
     * Check if the message is from a specific user.
     */
    public function isFrom($userId)
    {
        return $this->sender_id == $userId;
    }

    /**
     * Check if the message is to a specific user.
     */
    public function isTo($userId)
    {
        return $this->receiver_id == $userId;
    }

    /**
     * Get the other user in the conversation.
     */
    public function getOtherUserAttribute()
    {
        $currentUserId = auth()->id();
        return $this->sender_id == $currentUserId ? $this->receiver : $this->sender;
    }

    /**
     * Get formatted created at.
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y h:i A');
    }

    /**
     * Get time ago.
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Check if the message has replies.
     */
    public function hasReplies()
    {
        return $this->replies()->exists();
    }

    /**
     * Get the reply count.
     */
    public function getReplyCountAttribute()
    {
        return $this->replies()->count();
    }

    /**
     * Get the conversation ID (for grouping).
     */
    public function getConversationIdAttribute()
    {
        $ids = [$this->sender_id, $this->receiver_id];
        sort($ids);
        return 'conv_' . $ids[0] . '_' . $ids[1];
    }

    /**
     * Get the root message of the conversation.
     */
    public function getRootMessageAttribute()
    {
        return $this->parent_id ? self::find($this->parent_id) : $this;
    }

    /**
     * Get all messages in the same conversation.
     */
    public function getConversationMessagesAttribute()
    {
        return $this->getConversationThread();
    }

    /**
     * Get the latest message in the conversation.
     */
    public function getLatestMessageAttribute()
    {
        if ($this->parent_id) {
            $rootId = $this->parent_id;
        } else {
            $rootId = $this->id;
        }
        
        return self::where('id', $rootId)
            ->orWhere('parent_id', $rootId)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * Get the unread count in this conversation.
     */
    public function getUnreadCountAttribute()
    {
        $rootId = $this->parent_id ?? $this->id;
        $userId = auth()->id();
        
        return self::where(function($q) use ($rootId) {
                $q->where('id', $rootId)
                  ->orWhere('parent_id', $rootId);
            })
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->count();
    }
}