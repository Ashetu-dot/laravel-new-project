<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * Display messages for admin panel.
     */
    public function index()
    {
        $user = Auth::user();

        // Get all conversations for the current user (using parent-child relationship)
        $conversations = $this->getUserConversations($user->id);

        // Get unread count
        $unreadCount = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        // Get all users for new message modal (excluding current user)
        $users = User::where('id', '!=', $user->id)
            ->select('id', 'name', 'email', 'role', 'is_active')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        // Get notification counts
        $unreadNotificationsCount = $this->getUnreadNotificationsCount($user->id);
        $unreadMessagesCount = $unreadCount;

        return view('admin.messages.index', compact(
            'conversations',
            'unreadCount',
            'users',
            'user',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Display messages for customer panel.
     */
    public function customerMessages()
    {
        $user = Auth::user();

        // Get all conversations for the customer
        $conversations = $this->getUserConversations($user->id);

        // Get unread count
        $unreadCount = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        // Get admin users for customer to message
        $admins = User::where('role', 'admin')
            ->orWhere('role', 'super_admin')
            ->select('id', 'name', 'email')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('customer.messages', compact('conversations', 'unreadCount', 'admins', 'user'));
    }

    /**
     * Show a specific message and its conversation thread.
     */
    public function show($id)
    {
        $user = Auth::user();

        // Find the message
        $message = Message::with(['sender', 'receiver'])->findOrFail($id);

        // Check if user is part of this conversation
        if ($message->sender_id != $user->id && $message->receiver_id != $user->id) {
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            abort(403, 'Unauthorized access to this conversation.');
        }

        // Get the entire conversation thread
        // This gets the root message (parent_id is null) and all its replies
        $rootMessage = $message->parent_id ? Message::find($message->parent_id) : $message;

        if (!$rootMessage) {
            $rootMessage = $message;
        }

        // Get all messages in this thread
        $conversation = Message::with(['sender', 'receiver', 'replies'])
            ->where('id', $rootMessage->id)
            ->orWhere('parent_id', $rootMessage->id)
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark unread messages as read
        Message::whereIn('id', $conversation->pluck('id'))
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        // Get other user in conversation
        $otherUser = $message->sender_id == $user->id ? $message->receiver : $message->sender;

        // Get unread count for header
        $unreadCount = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        // Check if this is an API request
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'conversation' => $conversation,
                'other_user' => $otherUser
            ]);
        }

        // Determine which view to return based on user role
        if ($user->role === 'admin' || $user->role === 'super_admin') {
            $unreadNotificationsCount = $this->getUnreadNotificationsCount($user->id);

            return view('admin.messages.show', compact(
                'conversation',
                'otherUser',
                'user',
                'unreadCount',
                'unreadNotificationsCount',
                'rootMessage'
            ));
        } else {
            return view('customer.messages-show', compact(
                'conversation',
                'otherUser',
                'user',
                'unreadCount',
                'rootMessage'
            ));
        }
    }

    /**
     * Send a new message.
     */
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:5000',
            'subject' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Create the message
            $message = new Message();
            $message->sender_id = $user->id;
            $message->receiver_id = $request->receiver_id;
            $message->subject = $request->subject ?? $this->generateSubject($request->content);
            $message->content = $request->content;
            $message->is_read = false;
            $message->parent_id = null; // This is a root message
            $message->save();

            // Load relationships for response
            $message->load(['sender', 'receiver']);

            // Create notification for receiver
            $this->createMessageNotification($message);

            DB::commit();

            // Check if request expects JSON response (AJAX)
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Message sent successfully',
                    'data' => $message
                ]);
            }

            // Redirect based on user role
            if ($user->role === 'admin' || $user->role === 'super_admin') {
                return redirect()->route('admin.messages.show', $message->id)
                    ->with('success', 'Message sent successfully.');
            } else {
                return redirect()->route('customer.messages.show', $message->id)
                    ->with('success', 'Message sent successfully.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message send error: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send message: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to send message. Please try again.');
        }
    }

    /**
     * Reply to an existing message.
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Find the original message to reply to
            $parentMessage = Message::findOrFail($id);

            // Check if user is part of this conversation
            if ($parentMessage->sender_id != $user->id && $parentMessage->receiver_id != $user->id) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
                return back()->with('error', 'You are not authorized to reply to this message.');
            }

            // Determine receiver (the other user in the conversation)
            $receiverId = $parentMessage->sender_id == $user->id
                ? $parentMessage->receiver_id
                : $parentMessage->sender_id;

            // Determine the root parent ID (if this is a reply to a reply)
            $rootParentId = $parentMessage->parent_id ?? $parentMessage->id;

            // Create reply message
            $message = new Message();
            $message->sender_id = $user->id;
            $message->receiver_id = $receiverId;
            $message->subject = 'Re: ' . ($parentMessage->subject ?? 'Message');
            $message->content = $request->content;
            $message->is_read = false;
            $message->parent_id = $rootParentId;
            $message->save();

            // Load relationships
            $message->load(['sender', 'receiver']);

            // Create notification for receiver
            $this->createMessageNotification($message);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Reply sent successfully',
                    'data' => $message
                ]);
            }

            return redirect()->back()->with('success', 'Reply sent successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message reply error: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send reply: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to send reply. Please try again.');
        }
    }

    /**
     * Get conversation with a specific user (AJAX).
     */
    public function getConversation($userId)
    {
        try {
            $user = Auth::user();

            // Get all messages between these two users
            $messages = Message::with(['sender', 'receiver'])
                ->where(function($q) use ($user, $userId) {
                    $q->where(function($q1) use ($user, $userId) {
                        $q1->where('sender_id', $user->id)
                           ->where('receiver_id', $userId);
                    })->orWhere(function($q2) use ($user, $userId) {
                        $q2->where('sender_id', $userId)
                           ->where('receiver_id', $user->id);
                    });
                })
                ->orderBy('created_at', 'asc')
                ->get();

            // Mark received messages as read
            Message::whereIn('id', $messages->pluck('id'))
                ->where('receiver_id', $user->id)
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now()
                ]);

            // Get other user info (do not fail if deleted)
            $otherUser = User::find($userId);

            return response()->json([
                'success' => true,
                'messages' => $messages,
                'other_user' => $otherUser ? [
                    'id' => $otherUser->id,
                    'name' => $otherUser->name,
                    'email' => $otherUser->email,
                    'role' => $otherUser->role
                ] : null
            ]);

        } catch (\Exception $e) {
            Log::error('Get conversation error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to load conversation'
            ], 500);
        }
    }

    /**
     * Mark a message as read.
     */
    public function markAsRead(Request $request, $id)
    {
        try {
            $message = Message::findOrFail($id);

            // Only receiver can mark as read
            if ($message->receiver_id == Auth::id()) {
                $message->is_read = true;
                $message->read_at = now();
                $message->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Message marked as read'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);

        } catch (\Exception $e) {
            Log::error('Mark as read error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to mark message as read'
            ], 500);
        }
    }

    /**
     * Delete a message.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $message = Message::findOrFail($id);

            // Only sender or receiver can delete
            if ($message->sender_id == Auth::id() || $message->receiver_id == Auth::id()) {
                // Check if this message has replies
                $hasReplies = Message::where('parent_id', $message->id)->exists();

                if ($hasReplies) {
                    // If it has replies, just mark as deleted by user but keep for conversation
                    $message->content = '[This message has been deleted]';
                    $message->save();
                } else {
                    // No replies, safe to delete
                    $message->delete();
                }

                DB::commit();

                if (request()->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Message deleted successfully'
                    ]);
                }

                return redirect()->route('admin.messages')
                    ->with('success', 'Message deleted successfully.');
            }

            DB::rollBack();

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            return back()->with('error', 'You are not authorized to delete this message.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message delete error: ' . $e->getMessage());

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete message'
                ], 500);
            }

            return back()->with('error', 'Failed to delete message.');
        }
    }

    /**
     * Get unread messages count for current user.
     */
    public function getUnreadCount()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    /**
     * Get user conversations (latest message from each thread).
     */
    private function getUserConversations($userId, $limit = null)
    {
        // Get all root messages (parent_id is null) where user is involved
        $rootMessages = Message::with(['sender', 'receiver'])
            ->whereNull('parent_id')
            ->where(function($q) use ($userId) {
                $q->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $conversations = collect();

        foreach ($rootMessages as $root) {
            // Get the latest message in this thread (either the root or the latest reply)
            $latestMessage = Message::where(function($q) use ($root) {
                    $q->where('id', $root->id)
                      ->orWhere('parent_id', $root->id);
                })
                ->orderBy('created_at', 'desc')
                ->first();

            if ($latestMessage) {
                // Count unread replies in this thread
                $unreadCount = Message::where(function($q) use ($root) {
                        $q->where('id', $root->id)
                          ->orWhere('parent_id', $root->id);
                    })
                    ->where('receiver_id', $userId)
                    ->where('is_read', false)
                    ->count();

                $latestMessage->unread_count = $unreadCount;
                $latestMessage->reply_count = Message::where('parent_id', $root->id)->count();
                $conversations->push($latestMessage);
            }
        }

        // Sort by latest message
        $conversations = $conversations->sortByDesc('created_at')->values();

        if ($limit) {
            $conversations = $conversations->take($limit);
        }

        return $conversations;
    }

    /**
     * Generate a subject from content if not provided.
     */
    private function generateSubject($content)
    {
        // Truncate content to first 50 characters for subject
        $subject = substr($content, 0, 50);
        if (strlen($content) > 50) {
            $subject .= '...';
        }
        return $subject;
    }

    /**
     * Create a notification for the message receiver.
     */
    private function createMessageNotification($message)
    {
        try {
            // Check if Notification model exists
            if (class_exists('App\Models\Notification')) {
                $notification = new Notification();
                $notification->user_id = $message->receiver_id;
                $notification->type = 'message';
                $notification->title = 'New Message';
                $notification->content = "You have received a new message from " . $message->sender->name;
                $notification->data = json_encode([
                    'message_id' => $message->id,
                    'sender_id' => $message->sender_id,
                    'sender_name' => $message->sender->name
                ]);
                $notification->is_read = false;
                $notification->save();
            }
        } catch (\Exception $e) {
            // Log but don't fail if notification creation fails
            Log::warning('Failed to create message notification: ' . $e->getMessage());
        }
    }

    /**
     * Get unread notifications count.
     */
    private function getUnreadNotificationsCount($userId)
    {
        try {
            if (class_exists('App\Models\Notification')) {
                return Notification::where('user_id', $userId)
                    ->where('is_read', false)
                    ->count();
            }
        } catch (\Exception $e) {
            // Ignore if notifications table doesn't exist
        }

        return 0;
    }
}
