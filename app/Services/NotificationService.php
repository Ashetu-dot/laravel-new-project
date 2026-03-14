<?php
// app/Services/NotificationService.php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send a notification to a user.
     */
    public function send($userId, $title, $message, $type = 'system', $data = [])
    {
        try {
            return Notification::create([
                'user_id' => $userId,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'data' => $data,
                'is_read' => false,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send notification: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Send a notification to multiple users.
     */
    public function sendBulk(array $userIds, $title, $message, $type = 'system', $data = [])
    {
        $notifications = [];
        
        foreach ($userIds as $userId) {
            try {
                $notifications[] = [
                    'user_id' => $userId,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'data' => json_encode($data),
                    'is_read' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } catch (\Exception $e) {
                Log::error('Failed to prepare notification for user ' . $userId . ': ' . $e->getMessage());
            }
        }

        if (!empty($notifications)) {
            try {
                Notification::insert($notifications);
            } catch (\Exception $e) {
                Log::error('Failed to insert bulk notifications: ' . $e->getMessage());
            }
        }
    }

    /**
     * Send welcome notification to new user.
     */
    public function welcomeUser($userId, $userName)
    {
        $title = 'Welcome to Vendora!';
        $message = 'Welcome ' . $userName . '! We\'re excited to have you on board. Start exploring local vendors and products.';
        
        return $this->send($userId, $title, $message, 'success', ['user_name' => $userName]);
    }

    /**
     * Send order confirmation notification.
     */
    public function orderCreated($order)
    {
        $title = 'Order Confirmed';
        $message = 'Your order #' . $order->order_number . ' has been confirmed. Total: ' . number_format($order->total_amount) . ' ETB';
        
        return $this->send($order->user_id, $title, $message, 'order', ['order_id' => $order->id, 'order_number' => $order->order_number]);
    }

    /**
     * Send order status update notification.
     */
    public function orderStatusUpdated($order)
    {
        $title = 'Order Status Updated';
        $message = 'Your order #' . $order->order_number . ' is now ' . ucfirst($order->status) . '.';
        
        return $this->send($order->user_id, $title, $message, 'order', ['order_id' => $order->id, 'order_number' => $order->order_number, 'status' => $order->status]);
    }

    /**
     * Send new follower notification.
     */
    public function newFollower($vendorId, $followerName)
    {
        $title = 'New Follower';
        $message = $followerName . ' started following your shop.';
        
        return $this->send($vendorId, $title, $message, 'follow', ['follower_name' => $followerName]);
    }

    /**
     * Send new message notification.
     */
    public function newMessage($receiverId, $senderName, $messagePreview)
    {
        $title = 'New Message';
        $message = 'You have a new message from ' . $senderName . ': "' . $messagePreview . '"';
        
        return $this->send($receiverId, $title, $message, 'message', ['sender_name' => $senderName]);
    }

    /**
     * Send new review notification.
     */
    public function newReview($vendorId, $reviewerName, $rating)
    {
        $title = 'New Review';
        $message = $reviewerName . ' left a ' . $rating . '-star review on your shop.';
        
        return $this->send($vendorId, $title, $message, 'review', ['reviewer_name' => $reviewerName, 'rating' => $rating]);
    }

    /**
     * Notify all admins about new user registration.
     */
    public function notifyAdminsNewUser($user)
    {
        // Get all admin users
        $admins = User::where('role', 'admin')->where('is_active', true)->get();
        
        if ($admins->isEmpty()) {
            Log::warning('No active admins found to notify about new user registration');
            return;
        }

        $userType = ucfirst($user->role);
        $title = 'New ' . $userType . ' Registration';
        
        if ($user->role === 'vendor') {
            $message = 'New vendor "' . $user->business_name . '" (' . $user->name . ') has registered and requires verification.';
        } else {
            $message = 'New customer "' . $user->name . '" has registered and requires email verification.';
        }
        
        $data = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $user->role,
            'business_name' => $user->business_name ?? null,
            'requires_approval' => $user->role === 'vendor',
        ];

        $adminIds = $admins->pluck('id')->toArray();
        $this->sendBulk($adminIds, $title, $message, 'user_registration', $data);
        
        Log::info('Notified admins about new user registration', [
            'user_id' => $user->id,
            'user_role' => $user->role,
            'admin_count' => count($adminIds)
        ]);
    }
}