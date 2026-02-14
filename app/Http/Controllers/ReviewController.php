<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the vendor's product reviews.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get unread counts for header
        try {
            $unreadNotificationsCount = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadNotificationsCount = 0;
        }
        
        try {
            $unreadMessagesCount = Message::where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadMessagesCount = 0;
        }
        
        // Get vendor's product IDs
        $vendorProductIds = Product::where('vendor_id', $user->id)->pluck('id');
        
        // Build query for reviews on vendor's products
        $query = Review::whereIn('product_id', $vendorProductIds)
            ->with(['user', 'product'])
            ->orderBy('created_at', 'desc');
        
        // Filter by rating
        if ($request->has('rating') && !empty($request->rating)) {
            $query->where('rating', $request->rating);
        }
        
        // Filter by approval status
        if ($request->has('status') && $request->status === 'approved') {
            $query->where('is_approved', true);
        } elseif ($request->has('status') && $request->status === 'pending') {
            $query->where('is_approved', false);
        }
        
        // Filter by product
        if ($request->has('product_id') && !empty($request->product_id)) {
            $query->where('product_id', $request->product_id);
        }
        
        // Get statistics
        $totalReviews = $query->count();
        $averageRating = Review::whereIn('product_id', $vendorProductIds)->avg('rating') ?? 0;
        $pendingReviews = Review::whereIn('product_id', $vendorProductIds)->where('is_approved', false)->count();
        
        $ratingDistribution = [
            5 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 5)->count(),
            4 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 4)->count(),
            3 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 3)->count(),
            2 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 2)->count(),
            1 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 1)->count(),
        ];
        
        // Paginate results
        $reviews = $query->paginate(15)->withQueryString();
        
        // Get products for filter dropdown
        $products = Product::where('vendor_id', $user->id)->get();
        
        return view('vendor.reviews.index', compact(
            'reviews',
            'products',
            'totalReviews',
            'averageRating',
            'pendingReviews',
            'ratingDistribution',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Approve a review.
     */
    public function approve($id)
    {
        $user = Auth::user();
        
        $review = Review::whereHas('product', function($q) use ($user) {
            $q->where('vendor_id', $user->id);
        })->findOrFail($id);
        
        $review->is_approved = true;
        $review->save();
        
        return redirect()->back()->with('success', 'Review approved successfully!');
    }

    /**
     * Reject/delete a review.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        $review = Review::whereHas('product', function($q) use ($user) {
            $q->where('vendor_id', $user->id);
        })->findOrFail($id);
        
        $review->delete();
        
        return redirect()->back()->with('success', 'Review deleted successfully!');
    }

    /**
     * Get review statistics for AJAX.
     */
    public function getStats()
    {
        $user = Auth::user();
        $vendorProductIds = Product::where('vendor_id', $user->id)->pluck('id');
        
        $stats = [
            'total' => Review::whereIn('product_id', $vendorProductIds)->count(),
            'average' => Review::whereIn('product_id', $vendorProductIds)->avg('rating') ?? 0,
            'pending' => Review::whereIn('product_id', $vendorProductIds)->where('is_approved', false)->count(),
            'distribution' => [
                5 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 5)->count(),
                4 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 4)->count(),
                3 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 3)->count(),
                2 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 2)->count(),
                1 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 1)->count(),
            ]
        ];
        
        return response()->json($stats);
    }
}