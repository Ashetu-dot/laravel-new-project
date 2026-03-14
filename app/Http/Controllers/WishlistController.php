<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WishlistController extends Controller
{
    /**
     * Display a listing of the wishlist items.
     */
    public function index()
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

        // Get wishlist items with product and vendor details
        $wishlistItems = Wishlist::where('user_id', $user->id)
            ->with(['product' => function($query) {
                $query->with(['vendor']);
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('customer.wishlist.index', compact(
            'user',
            'wishlistItems',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Add a product to wishlist.
     */
    public function add(Request $request, $productId)
    {
        try {
            $user = Auth::user();
            $product = Product::findOrFail($productId);

            // Check if already in wishlist
            $exists = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->exists();

            if (!$exists) {
                Wishlist::create([
                    'user_id' => $user->id,
                    'product_id' => $productId
                ]);

                Log::info('Product added to wishlist', [
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'product_name' => $product->name
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Product added to wishlist',
                    'action' => 'added'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Product already in wishlist'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Product not found when adding to wishlist: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error adding to wishlist: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add to wishlist'
            ], 500);
        }
    }

    /**
     * Remove a product from wishlist.
     */
    public function remove(Request $request, $productId)
    {
        try {
            $user = Auth::user();

            $deleted = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->delete();

            if ($deleted) {
                Log::info('Product removed from wishlist', [
                    'user_id' => $user->id,
                    'product_id' => $productId
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist',
                    'action' => 'removed'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist'
            ]);

        } catch (\Exception $e) {
            Log::error('Error removing from wishlist: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove from wishlist'
            ], 500);
        }
    }

    /**
     * Remove a wishlist item by ID.
     */
    public function removeById($id)
    {
        try {
            $user = Auth::user();

            $wishlistItem = Wishlist::where('id', $id)
                ->where('user_id', $user->id)
                ->firstOrFail();

            $productId = $wishlistItem->product_id;
            $wishlistItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Item removed from wishlist',
                'product_id' => $productId
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Wishlist item not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error removing wishlist item: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item'
            ], 500);
        }
    }

    /**
     * Check if product is in wishlist (AJAX).
     */
    public function check($productId)
    {
        try {
            $user = Auth::user();
            $exists = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->exists();

            return response()->json([
                'success' => true,
                'in_wishlist' => $exists
            ]);

        } catch (\Exception $e) {
            Log::error('Error checking wishlist: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to check wishlist'
            ], 500);
        }
    }

    /**
     * Get wishlist count (AJAX).
     */
    public function getCount()
    {
        try {
            $user = Auth::user();
            $count = Wishlist::where('user_id', $user->id)->count();

            return response()->json([
                'success' => true,
                'count' => $count
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting wishlist count: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'count' => 0
            ], 500);
        }
    }

    /**
     * Clear entire wishlist.
     */
    public function clear()
    {
        try {
            $user = Auth::user();
            $count = Wishlist::where('user_id', $user->id)->count();
            
            Wishlist::where('user_id', $user->id)->delete();

            Log::info('Wishlist cleared', [
                'user_id' => $user->id,
                'items_removed' => $count
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Wishlist cleared successfully',
                'count' => $count
            ]);

        } catch (\Exception $e) {
            Log::error('Error clearing wishlist: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear wishlist'
            ], 500);
        }
    }

    /**
     * Move wishlist item to cart.
     */
    public function moveToCart(Request $request, $productId)
    {
        try {
            $user = Auth::user();

            // Check if product exists and is in wishlist
            $product = Product::where('id', $productId)
                ->where('is_active', true)
                ->first();
            
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found or unavailable'
                ], 404);
            }
            
            $inWishlist = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->exists();

            if (!$inWishlist) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in wishlist'
                ], 404);
            }

            // Check stock
            if ($product->stock <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is out of stock'
                ]);
            }

            // Add to cart
            $existingCart = \App\Models\Cart::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($existingCart) {
                // Update quantity if already in cart
                if ($existingCart->quantity < $product->stock) {
                    $existingCart->increment('quantity');
                    $message = 'Product quantity updated in cart';
                } else {
                    $message = 'Product already in cart with maximum available quantity';
                }
            } else {
                // Add new cart item
                \App\Models\Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => 1,
                    'options' => null,
                ]);
                $message = 'Product moved to cart successfully';
            }
            
            // Remove from wishlist
            Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->delete();

            Log::info('Product moved from wishlist to cart', [
                'user_id' => $user->id,
                'product_id' => $productId
            ]);

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => \App\Models\Cart::where('user_id', $user->id)->count()
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error moving to cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to move to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk remove items from wishlist.
     */
    public function bulkRemove(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id'
        ]);

        try {
            $user = Auth::user();
            
            $deleted = Wishlist::where('user_id', $user->id)
                ->whereIn('product_id', $request->product_ids)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => $deleted . ' items removed from wishlist',
                'count' => $deleted
            ]);

        } catch (\Exception $e) {
            Log::error('Error bulk removing from wishlist: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove items'
            ], 500);
        }
    }

    /**
     * Get wishlist items for API.
     */
    public function apiIndex()
    {
        try {
            $user = Auth::user();
            
            $items = Wishlist::where('user_id', $user->id)
                ->with(['product' => function($query) {
                    $query->with('vendor');
                }])
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name ?? 'Unknown Product',
                        'product_description' => $item->product->description ?? '',
                        'product_price' => $item->product->price ?? 0,
                        'product_original_price' => $item->product->original_price ?? null,
                        'product_image' => $item->product->image ? Storage::url($item->product->image) : null,
                        'product_images' => $item->product->images ? collect($item->product->images)->map(function($image) {
                            return Storage::url($image);
                        }) : [],
                        'vendor_id' => $item->product->vendor->id ?? null,
                        'vendor_name' => $item->product->vendor->business_name ?? $item->product->vendor->name ?? 'Unknown Vendor',
                        'in_stock' => ($item->product->stock ?? 0) > 0,
                        'stock_quantity' => $item->product->stock ?? 0,
                        'rating' => $item->product->rating ?? 0,
                        'reviews_count' => $item->product->total_reviews ?? 0,
                        'added_at' => $item->created_at->toISOString(),
                        'added_at_formatted' => $item->created_at->diffForHumans()
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $items,
                'count' => $items->count(),
                'total' => $items->count()
            ]);

        } catch (\Exception $e) {
            Log::error('API wishlist error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch wishlist'
            ], 500);
        }
    }

    /**
     * API endpoint to add to wishlist.
     */
    public function apiAdd($productId)
    {
        try {
            $user = Auth::user();
            $product = Product::findOrFail($productId);

            // Check if already in wishlist
            $exists = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->exists();

            if (!$exists) {
                $wishlist = Wishlist::create([
                    'user_id' => $user->id,
                    'product_id' => $productId
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Product added to wishlist',
                    'data' => [
                        'id' => $wishlist->id,
                        'product_id' => $productId
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Product already in wishlist'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('API add to wishlist error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add to wishlist'
            ], 500);
        }
    }

    /**
     * API endpoint to remove from wishlist.
     */
    public function apiRemove($productId)
    {
        try {
            $user = Auth::user();

            $deleted = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist'
            ], 404);

        } catch (\Exception $e) {
            Log::error('API remove from wishlist error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove from wishlist'
            ], 500);
        }
    }

    /**
     * API endpoint to check wishlist status for multiple products.
     */
    public function apiCheckBatch(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'integer'
        ]);

        try {
            $user = Auth::user();
            
            $wishlistItems = Wishlist::where('user_id', $user->id)
                ->whereIn('product_id', $request->product_ids)
                ->pluck('product_id')
                ->toArray();

            $result = [];
            foreach ($request->product_ids as $productId) {
                $result[$productId] = in_array($productId, $wishlistItems);
            }

            return response()->json([
                'success' => true,
                'data' => $result
            ]);

        } catch (\Exception $e) {
            Log::error('API batch check error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to check wishlist status'
            ], 500);
        }
    }
}