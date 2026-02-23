<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login to view your cart.');
            }

            $cartItems = Cart::where('user_id', $user->id)
                ->with('product')
                ->get();

            $subtotal = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });

            $tax = $subtotal * 0.15; // 15% VAT (Ethiopia)
            $total = $subtotal + $tax;

            return view('cart.index', compact('cartItems', 'subtotal', 'tax', 'total'));

        } catch (\Exception $e) {
            Log::error('Cart index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load cart.');
        }
    }

    /**
     * Add item to cart.
     */
    public function add(Request $request, Product $product)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Please login first'], 401);
                }
                return redirect()->route('login')->with('error', 'Please login to add items to cart.');
            }

            $request->validate([
                'quantity' => 'required|integer|min:1|max:' . ($product->stock_quantity ?? 100),
                'options' => 'nullable|array',
            ]);

            // Check if product already in cart
            $existingCart = Cart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCart) {
                // Update quantity
                $existingCart->quantity += $request->quantity;
                $existingCart->save();
                $message = 'Cart updated successfully.';
            } else {
                // Add new cart item
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'options' => $request->options,
                ]);
                $message = 'Product added to cart successfully.';
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'cart_count' => Cart::where('user_id', $user->id)->count()
                ]);
            }

            return redirect()->route('customer.cart.index')->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Cart add error: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to add to cart'], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to add to cart.');
        }
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, Cart $cart)
    {
        try {
            $user = Auth::user();
            
            if (!$user || $cart->user_id !== $user->id) {
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
                }
                abort(403);
            }

            $request->validate([
                'quantity' => 'required|integer|min:1|max:' . ($cart->product->stock_quantity ?? 100),
            ]);

            $cart->quantity = $request->quantity;
            $cart->save();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cart updated successfully',
                    'subtotal' => $cart->subtotal
                ]);
            }

            return redirect()->route('customer.cart.index')->with('success', 'Cart updated successfully.');

        } catch (\Exception $e) {
            Log::error('Cart update error: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to update cart'], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to update cart.');
        }
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request, Cart $cart)
    {
        try {
            $user = Auth::user();
            
            if (!$user || $cart->user_id !== $user->id) {
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
                }
                abort(403);
            }

            $cart->delete();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from cart',
                    'cart_count' => Cart::where('user_id', $user->id)->count()
                ]);
            }

            return redirect()->route('customer.cart.index')->with('success', 'Item removed from cart.');

        } catch (\Exception $e) {
            Log::error('Cart remove error: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to remove item'], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to remove item from cart.');
        }
    }

    /**
     * Clear the entire cart.
     */
    public function clear(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
                }
                return redirect()->route('login');
            }

            Cart::where('user_id', $user->id)->delete();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cart cleared successfully'
                ]);
            }

            return redirect()->route('customer.cart.index')->with('success', 'Cart cleared successfully.');

        } catch (\Exception $e) {
            Log::error('Cart clear error: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to clear cart'], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to clear cart.');
        }
    }

    /**
     * Get cart preview for header dropdown.
     */
    public function preview()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['items' => [], 'count' => 0, 'total' => 0]);
            }

            $cartItems = Cart::where('user_id', $user->id)
                ->with('product')
                ->latest()
                ->take(5)
                ->get();

            $count = Cart::where('user_id', $user->id)->count();
            $total = $cartItems->sum('subtotal');

            $items = $cartItems->map(function($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->subtotal,
                    'image' => $item->product->image ? asset('storage/' . $item->product->image) : null,
                ];
            });

            return response()->json([
                'items' => $items,
                'count' => $count,
                'total' => $total
            ]);

        } catch (\Exception $e) {
            Log::error('Cart preview error: ' . $e->getMessage());
            return response()->json(['items' => [], 'count' => 0, 'total' => 0], 500);
        }
    }

    /**
     * Get cart count for header badge.
     */
    public function getCount()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['count' => 0]);
            }

            $count = Cart::where('user_id', $user->id)->count();

            return response()->json(['count' => $count]);

        } catch (\Exception $e) {
            Log::error('Cart count error: ' . $e->getMessage());
            return response()->json(['count' => 0], 500);
        }
    }
}