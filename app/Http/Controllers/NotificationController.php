<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications for customers.
     */
    public function customerNotifications(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Display a listing of the notifications.
     */
    public function index(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login to view notifications.');
            }

            $query = Notification::where('user_id', $user->id);

            // Filter by type if specified
            if ($request->has('type') && $request->type != 'all' && $request->type != '') {
                $query->where('type', $request->type);
            }

            // Filter by read/unread
            if ($request->has('filter')) {
                if ($request->filter == 'unread') {
                    $query->where('is_read', false);
                } elseif ($request->filter == 'read') {
                    $query->where('is_read', true);
                }
            }

            // Search in title and message
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('message', 'like', "%{$search}%");
                });
            }

            // Get paginated notifications
            $notifications = $query->orderBy('created_at', 'desc')
                                   ->paginate(20)
                                   ->withQueryString();

            // Get counts for filters
            $totalCount = Notification::where('user_id', $user->id)->count();
            $unreadCount = Notification::where('user_id', $user->id)
                                       ->where('is_read', false)
                                       ->count();
            $readCount = $totalCount - $unreadCount;

            // Get counts by type
            $typeCounts = Notification::where('user_id', $user->id)
                                      ->selectRaw('type, count(*) as count')
                                      ->groupBy('type')
                                      ->pluck('count', 'type')
                                      ->toArray();

            // Determine which view to return based on user role
            if ($user->role === 'customer') {
                return view('customer.notifications', compact(
                    'notifications',
                    'totalCount',
                    'unreadCount',
                    'readCount',
                    'typeCounts'
                ));
            } elseif ($user->role === 'vendor') {
                return view('vendor.notifications', compact(
                    'notifications',
                    'totalCount',
                    'unreadCount',
                    'readCount',
                    'typeCounts'
                ));
            } elseif ($user->role === 'admin') {
                return view('admin.notifications', compact(
                    'notifications',
                    'totalCount',
                    'unreadCount',
                    'readCount',
                    'typeCounts'
                ));
            }

            return view('notifications.index', compact(
                'notifications',
                'totalCount',
                'unreadCount',
                'readCount',
                'typeCounts'
            ));

        } catch (\Exception $e) {
            Log::error('Notification index error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Unable to load notifications. Please try again.');
        }
    }

    /**
     * Get single notification details.
     */
    public function show($id)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                if (request()->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized'
                    ], 401);
                }
                return redirect()->route('login');
            }

            $notification = Notification::where('user_id', $user->id)
                ->findOrFail($id);

            // Parse data if it's a string
            if ($notification->data && is_string($notification->data)) {
                $notification->data = json_decode($notification->data, true);
            }

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $notification
                ]);
            }

            return view('notifications.show', compact('notification'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Notification not found: ' . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Notification not found'
                ], 404);
            }

            return redirect()->back()->with('error', 'Notification not found');
            
        } catch (\Exception $e) {
            Log::error('Show notification error: ' . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to load notification details'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to load notification details');
        }
    }

    /**
     * Get unread notifications count for header.
     */
    public function getUnreadCount()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['count' => 0]);
            }

            $count = Notification::where('user_id', $user->id)
                                 ->where('is_read', false)
                                 ->count();

            return response()->json(['count' => $count]);

        } catch (\Exception $e) {
            Log::error('Get unread count error: ' . $e->getMessage());
            return response()->json(['count' => 0], 500);
        }
    }

    /**
     * Get recent notifications for dropdown.
     */
    public function getRecent()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $notifications = Notification::where('user_id', $user->id)
                                         ->orderBy('created_at', 'desc')
                                         ->limit(5)
                                         ->get()
                                         ->map(function($notification) {
                                            return [
                                                'id' => $notification->id,
                                                'title' => $notification->title,
                                                'message' => Str::limit($notification->message, 50),
                                                'time' => $notification->created_at->diffForHumans(),
                                                'is_read' => $notification->is_read,
                                                'type' => $notification->type,
                                                'icon' => $this->getNotificationIcon($notification->type),
                                            ];
                                         });

            $unreadCount = Notification::where('user_id', $user->id)
                                       ->where('is_read', false)
                                       ->count();

            return response()->json([
                'success' => true,
                'notifications' => $notifications,
                'unread_count' => $unreadCount
            ]);

        } catch (\Exception $e) {
            Log::error('Get recent notifications error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get notifications'], 500);
        }
    }

    /**
     * Get notification icon based on type.
     */
    private function getNotificationIcon($type)
    {
        $icons = [
            'order' => 'ri-shopping-bag-line',
            'message' => 'ri-message-3-line',
            'follow' => 'ri-user-follow-line',
            'review' => 'ri-star-line',
            'system' => 'ri-information-line',
            'promotion' => 'ri-discount-percent-line',
            'warning' => 'ri-alert-line',
            'success' => 'ri-checkbox-circle-line',
            'error' => 'ri-error-warning-line',
        ];

        return $icons[$type] ?? 'ri-notification-line';
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                if (request()->wantsJson()) {
                    return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
                }
                return redirect()->route('login');
            }

            $notification = Notification::where('user_id', $user->id)
                                        ->findOrFail($id);
            
            $notification->is_read = true;
            $notification->read_at = now();
            $notification->save();

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return back()->with('success', 'Notification marked as read.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'error' => 'Notification not found'], 404);
            }
            return back()->with('error', 'Notification not found.');
            
        } catch (\Exception $e) {
            Log::error('Mark as read error: ' . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'error' => 'Failed to mark as read'], 500);
            }
            
            return back()->with('error', 'Failed to mark notification as read.');
        }
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                if (request()->wantsJson()) {
                    return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
                }
                return redirect()->route('login');
            }

            Notification::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->update([
                            'is_read' => true,
                            'read_at' => now()
                        ]);

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return back()->with('success', 'All notifications marked as read.');

        } catch (\Exception $e) {
            Log::error('Mark all as read error: ' . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'error' => 'Failed to mark all as read'], 500);
            }
            
            return back()->with('error', 'Failed to mark all notifications as read.');
        }
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                if (request()->wantsJson()) {
                    return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
                }
                return redirect()->route('login');
            }

            $notification = Notification::where('user_id', $user->id)
                                        ->findOrFail($id);
            
            $notification->delete();

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return back()->with('success', 'Notification deleted successfully.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'error' => 'Notification not found'], 404);
            }
            return back()->with('error', 'Notification not found.');
            
        } catch (\Exception $e) {
            Log::error('Delete notification error: ' . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'error' => 'Failed to delete notification'], 500);
            }
            
            return back()->with('error', 'Failed to delete notification.');
        }
    }

    /**
     * Clear all notifications.
     */
    public function clearAll()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                if (request()->wantsJson()) {
                    return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
                }
                return redirect()->route('login');
            }

            Notification::where('user_id', $user->id)->delete();

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return back()->with('success', 'All notifications cleared successfully.');

        } catch (\Exception $e) {
            Log::error('Clear all notifications error: ' . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'error' => 'Failed to clear notifications'], 500);
            }
            
            return back()->with('error', 'Failed to clear notifications.');
        }
    }
}