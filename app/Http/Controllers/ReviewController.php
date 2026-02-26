<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'LIKE', "%{$search}%")
                              ->orWhere('email', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('product', function($productQuery) use ($search) {
                    $productQuery->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhere('comment', 'LIKE', "%{$search}%")
                ->orWhere('title', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter by rating
        if ($request->has('rating') && !empty($request->rating)) {
            $query->where('rating', $request->rating);
        }
        
        // Filter by approval status
        if ($request->has('status') && $request->status === 'approved') {
            $query->where('is_approved', true);
        } elseif ($request->has('status') && $request->status === 'pending') {
            $query->whereNull('is_approved');
        } elseif ($request->has('status') && $request->status === 'rejected') {
            $query->where('is_approved', false);
        }
        
        // Filter by product
        if ($request->has('product_id') && !empty($request->product_id)) {
            $query->where('product_id', $request->product_id);
        }
        
        // Sorting
        if ($request->has('sort') && !empty($request->sort)) {
            switch ($request->sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'highest':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'lowest':
                    $query->orderBy('rating', 'asc');
                    break;
            }
        }
        
        // Get statistics
        $totalReviews = Review::whereIn('product_id', $vendorProductIds)->count();
        $averageRating = round(Review::whereIn('product_id', $vendorProductIds)->where('is_approved', true)->avg('rating') ?? 0, 1);
        $pendingReviews = Review::whereIn('product_id', $vendorProductIds)->whereNull('is_approved')->count();
        $approvedReviews = Review::whereIn('product_id', $vendorProductIds)->where('is_approved', true)->count();
        $rejectedReviews = Review::whereIn('product_id', $vendorProductIds)->where('is_approved', false)->count();
        $productsWithReviews = Review::whereIn('product_id', $vendorProductIds)->distinct('product_id')->count('product_id');
        
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
        $products = Product::where('vendor_id', $user->id)->select('id', 'name')->get();
        
        return view('vendor.reviews.index', compact(
            'reviews',
            'products',
            'totalReviews',
            'averageRating',
            'pendingReviews',
            'approvedReviews',
            'rejectedReviews',
            'productsWithReviews',
            'ratingDistribution',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Get a single review details (AJAX).
     */
    public function show($id)
    {
        $user = Auth::user();
        
        try {
            $review = Review::where('id', $id)
                ->whereHas('product', function($q) use ($user) {
                    $q->where('vendor_id', $user->id);
                })
                ->with(['user', 'product'])
                ->firstOrFail();

            // Process images if they exist
            $images = [];
            if ($review->images) {
                if (is_string($review->images)) {
                    $decoded = json_decode($review->images, true);
                    $images = $decoded ?: [];
                } elseif (is_array($review->images)) {
                    $images = $review->images;
                }
                
                // Convert to full URLs
                $images = array_map(function($image) {
                    return Storage::url($image);
                }, $images);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'title' => $review->title,
                    'comment' => $review->comment,
                    'images' => $images,
                    'is_approved' => $review->is_approved,
                    'created_at' => $review->created_at->format('M d, Y'),
                    'created_at_diff' => $review->created_at->diffForHumans(),
                    'product' => [
                        'id' => $review->product->id,
                        'name' => $review->product->name,
                        'image' => $review->product->image ? Storage::url($review->product->image) : null,
                        'category' => $review->product->category,
                    ],
                    'customer' => [
                        'id' => $review->user->id,
                        'name' => $review->user->name,
                        'email' => $review->user->email,
                        'avatar' => $review->user->avatar ? Storage::url($review->user->avatar) : null,
                        'initials' => strtoupper(substr($review->user->name, 0, 2)),
                        'reviews_count' => Review::where('user_id', $review->user->id)->count(),
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching review details: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Review not found'
            ], 404);
        }
    }

    /**
     * Approve a review.
     */
    public function approve($id)
    {
        $user = Auth::user();
        
        try {
            $review = Review::whereHas('product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })->findOrFail($id);
            
            $review->is_approved = true;
            $review->approved_at = now();
            $review->save();
            
            // Update product average rating
            $this->updateProductRating($review->product_id);
            
            // Create notification for the customer
            try {
                Notification::create([
                    'user_id' => $review->user_id,
                    'type' => 'review_approved',
                    'title' => 'Review Approved',
                    'message' => 'Your review for ' . $review->product->name . ' has been approved and published.',
                    'data' => json_encode([
                        'review_id' => $review->id,
                        'product_id' => $review->product_id,
                        'product_name' => $review->product->name
                    ]),
                    'is_read' => false,
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to create review approval notification: ' . $e->getMessage());
            }
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Review approved successfully'
                ]);
            }
            
            return redirect()->back()->with('success', 'Review approved successfully!');
        } catch (\Exception $e) {
            Log::error('Error approving review: ' . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to approve review'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to approve review.');
        }
    }

    /**
     * Reject a review.
     */
    public function reject($id)
    {
        $user = Auth::user();
        
        try {
            $review = Review::whereHas('product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })->findOrFail($id);
            
            $review->is_approved = false;
            $review->rejected_at = now();
            $review->save();
            
            // Create notification for the customer
            try {
                Notification::create([
                    'user_id' => $review->user_id,
                    'type' => 'review_rejected',
                    'title' => 'Review Not Approved',
                    'message' => 'Your review for ' . $review->product->name . ' was not approved.',
                    'data' => json_encode([
                        'review_id' => $review->id,
                        'product_id' => $review->product_id,
                        'product_name' => $review->product->name
                    ]),
                    'is_read' => false,
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to create review rejection notification: ' . $e->getMessage());
            }
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Review rejected successfully'
                ]);
            }
            
            return redirect()->back()->with('success', 'Review rejected successfully!');
        } catch (\Exception $e) {
            Log::error('Error rejecting review: ' . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to reject review'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to reject review.');
        }
    }

    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        try {
            $review = Review::whereHas('product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })->findOrFail($id);
            
            $productId = $review->product_id;
            $productName = $review->product->name;
            
            // Delete associated images if they exist
            if ($review->images) {
                $images = is_string($review->images) ? json_decode($review->images, true) : $review->images;
                if (is_array($images)) {
                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
            
            $review->delete();
            
            // Update product average rating
            $this->updateProductRating($productId);
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Review deleted successfully'
                ]);
            }
            
            return redirect()->back()->with('success', 'Review deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting review: ' . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete review'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to delete review.');
        }
    }

    /**
     * Update product's average rating based on approved reviews.
     */
    private function updateProductRating($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $averageRating = Review::where('product_id', $productId)
                ->where('is_approved', true)
                ->avg('rating') ?? 0;
            
            $totalReviews = Review::where('product_id', $productId)
                ->where('is_approved', true)
                ->count();
            
            $product->rating = round($averageRating, 1);
            $product->total_reviews = $totalReviews;
            $product->save();
            
            // Also update vendor's overall rating
            $this->updateVendorRating($product->vendor_id);
        }
    }

    /**
     * Update vendor's overall average rating based on all their products.
     */
    private function updateVendorRating($vendorId)
    {
        $productIds = Product::where('vendor_id', $vendorId)->pluck('id');
        
        $averageRating = Review::whereIn('product_id', $productIds)
            ->where('is_approved', true)
            ->avg('rating') ?? 0;
        
        $totalReviews = Review::whereIn('product_id', $productIds)
            ->where('is_approved', true)
            ->count();
        
        $vendor = User::find($vendorId);
        if ($vendor) {
            $vendor->rating = round($averageRating, 1);
            $vendor->total_reviews = $totalReviews;
            $vendor->save();
        }
    }

    /**
     * Get review statistics for AJAX.
     */
    public function getStats()
    {
        $user = Auth::user();
        $vendorProductIds = Product::where('vendor_id', $user->id)->pluck('id');
        
        try {
            $stats = [
                'total' => Review::whereIn('product_id', $vendorProductIds)->count(),
                'average' => round(Review::whereIn('product_id', $vendorProductIds)->where('is_approved', true)->avg('rating') ?? 0, 1),
                'approved' => Review::whereIn('product_id', $vendorProductIds)->where('is_approved', true)->count(),
                'pending' => Review::whereIn('product_id', $vendorProductIds)->whereNull('is_approved')->count(),
                'rejected' => Review::whereIn('product_id', $vendorProductIds)->where('is_approved', false)->count(),
                'products_with_reviews' => Review::whereIn('product_id', $vendorProductIds)->distinct('product_id')->count('product_id'),
                'distribution' => [
                    5 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 5)->count(),
                    4 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 4)->count(),
                    3 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 3)->count(),
                    2 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 2)->count(),
                    1 => Review::whereIn('product_id', $vendorProductIds)->where('rating', 1)->count(),
                ]
            ];
            
            return response()->json($stats);
        } catch (\Exception $e) {
            Log::error('Error fetching review stats: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch review statistics'
            ], 500);
        }
    }

    /**
     * Bulk approve multiple reviews.
     */
    public function bulkApprove(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'review_ids' => 'required|array',
            'review_ids.*' => 'integer'
        ]);
        
        try {
            $reviews = Review::whereHas('product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })->whereIn('id', $request->review_ids)->get();
            
            foreach ($reviews as $review) {
                $review->is_approved = true;
                $review->approved_at = now();
                $review->save();
                
                // Update product rating
                $this->updateProductRating($review->product_id);
            }
            
            return response()->json([
                'success' => true,
                'message' => count($reviews) . ' reviews approved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error bulk approving reviews: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to bulk approve reviews'
            ], 500);
        }
    }

    /**
     * Bulk delete multiple reviews.
     */
    public function bulkDelete(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'review_ids' => 'required|array',
            'review_ids.*' => 'integer'
        ]);
        
        try {
            $reviews = Review::whereHas('product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })->whereIn('id', $request->review_ids)->get();
            
            $productIds = [];
            foreach ($reviews as $review) {
                $productIds[] = $review->product_id;
                
                // Delete images
                if ($review->images) {
                    $images = is_string($review->images) ? json_decode($review->images, true) : $review->images;
                    if (is_array($images)) {
                        foreach ($images as $image) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                }
            }
            
            Review::whereIn('id', $request->review_ids)->delete();
            
            // Update ratings for affected products
            foreach (array_unique($productIds) as $productId) {
                $this->updateProductRating($productId);
            }
            
            return response()->json([
                'success' => true,
                'message' => count($reviews) . ' reviews deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error bulk deleting reviews: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to bulk delete reviews'
            ], 500);
        }
    }

    /**
     * Export reviews as CSV.
     */
    public function export(Request $request)
    {
        $user = Auth::user();
        $vendorProductIds = Product::where('vendor_id', $user->id)->pluck('id');
        
        $query = Review::whereIn('product_id', $vendorProductIds)
            ->with(['user', 'product'])
            ->orderBy('created_at', 'desc');
        
        // Apply filters if provided
        if ($request->has('rating') && !empty($request->rating)) {
            $query->where('rating', $request->rating);
        }
        
        if ($request->has('status') && $request->status === 'approved') {
            $query->where('is_approved', true);
        } elseif ($request->has('status') && $request->status === 'pending') {
            $query->whereNull('is_approved');
        } elseif ($request->has('status') && $request->status === 'rejected') {
            $query->where('is_approved', false);
        }
        
        $reviews = $query->get();
        
        $filename = 'reviews-export-' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($reviews) {
            $handle = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($handle, [
                'ID',
                'Product',
                'Customer',
                'Email',
                'Rating',
                'Title',
                'Review',
                'Status',
                'Date'
            ]);
            
            foreach ($reviews as $review) {
                $status = 'Pending';
                if ($review->is_approved === true) {
                    $status = 'Approved';
                } elseif ($review->is_approved === false) {
                    $status = 'Rejected';
                }
                
                fputcsv($handle, [
                    $review->id,
                    $review->product->name,
                    $review->user->name,
                    $review->user->email,
                    $review->rating,
                    $review->title ?? '',
                    $review->comment,
                    $status,
                    $review->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($handle);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}