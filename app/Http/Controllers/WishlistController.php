<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the wishlist.
     */
    public function index()
    {
        return view('wishlist.index');
    }

    /**
     * Add a product to wishlist.
     */
    public function add(Request $request, $productId)
    {
        // Add to wishlist logic
        return response()->json(['success' => true]);
    }

    /**
     * Remove a product from wishlist.
     */
    public function remove(Request $request, $productId)
    {
        // Remove from wishlist logic
        return response()->json(['success' => true]);
    }

    // API methods
    public function apiIndex()
    {
        return response()->json([]);
    }

    public function apiAdd($productId)
    {
        return response()->json(['success' => true]);
    }

    public function apiRemove($productId)
    {
        return response()->json(['success' => true]);
    }
}