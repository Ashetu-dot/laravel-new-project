<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the vendor's products.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get unread notifications count with error handling
        try {
            $unreadNotificationsCount = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadNotificationsCount = 0;
            Log::warning('Notifications table might not exist: ' . $e->getMessage());
        }
        
        // Get unread messages count with error handling
        try {
            $unreadMessagesCount = Message::where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadMessagesCount = 0;
            Log::warning('Messages table might not exist: ' . $e->getMessage());
        }
        
        // Get categories for filter dropdown with error handling
        try {
            // Try to get vendor-specific and global categories
            $categories = Category::where('vendor_id', $user->id)
                ->orWhere('is_global', true)
                ->get();
                
            // If no categories found, try to get all categories
            if ($categories->isEmpty()) {
                $categories = Category::all();
            }
        } catch (QueryException $e) {
            // Fallback to all categories if columns don't exist
            try {
                $categories = Category::all();
            } catch (\Exception $e) {
                $categories = collect([]);
                Log::error('Categories table might not exist: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            $categories = collect([]);
            Log::error('Error fetching categories: ' . $e->getMessage());
        }
        
        // Build query with filters
        $query = Product::where('vendor_id', $user->id);
        
        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }
        
        // Category filter - check if category_id column exists
        if ($request->has('category') && !empty($request->category)) {
            try {
                $query->where('category_id', $request->category);
            } catch (QueryException $e) {
                // If category_id doesn't exist, try using category column
                $category = Category::find($request->category);
                if ($category) {
                    $query->where('category', $category->name);
                }
            }
        }
        
        // Status filter - check if is_active column exists
        if ($request->has('status') && !empty($request->status)) {
            try {
                switch($request->status) {
                    case 'active':
                        $query->where('is_active', true);
                        break;
                    case 'inactive':
                        $query->where('is_active', false);
                        break;
                    case 'low-stock':
                        $query->where('stock', '<', 10)
                              ->where('stock', '>', 0);
                        break;
                    case 'out-of-stock':
                        $query->where('stock', '<=', 0);
                        break;
                }
            } catch (QueryException $e) {
                // Fallback to status column
                if ($request->status === 'active') {
                    $query->where('status', true);
                } elseif ($request->status === 'inactive') {
                    $query->where('status', false);
                }
            }
        }
        
        // Sorting
        switch($request->get('sort', 'newest')) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'name-asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        // Paginate results
        $products = $query->paginate(12)->withQueryString();
        
        return view('vendor.products.index', compact(
            'products', 
            'categories', 
            'unreadNotificationsCount', 
            'unreadMessagesCount'
        ));
    }
    

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $user = Auth::user();
        
        // Get categories for dropdown with multiple fallback levels
        try {
            // Try to get vendor-specific and global categories
            $categories = Category::where('vendor_id', $user->id)
                ->orWhere('is_global', true)
                ->get();
                
            // If no categories found, try to get all categories
            if ($categories->isEmpty()) {
                $categories = Category::all();
            }
        } catch (QueryException $e) {
            // If columns don't exist, get all categories
            try {
                $categories = Category::all();
            } catch (\Exception $e) {
                // If table doesn't exist or is empty, create an empty collection
                $categories = collect([]);
                Log::warning('Categories table issue in create: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            $categories = collect([]);
            Log::error('Error in create method: ' . $e->getMessage());
        }
        
        // Get unread counts for header with error handling
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
        
        return view('vendor.products.create', compact(
            'categories', 
            'unreadNotificationsCount', 
            'unreadMessagesCount'
        ));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $vendor = Auth::user();

        if (!$vendor || $vendor->role !== 'vendor') {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:50|unique:products,sku',
            'description' => 'required|string|max:5000',
            'tags' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                try {
                    $path = $image->store('products/' . $vendor->id, 'public');
                    $imagePaths[] = $path;
                } catch (\Exception $e) {
                    Log::error('Image upload failed: ' . $e->getMessage());
                }
            }
        }

        // Process tags
        $tags = [];
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $tags = array_filter($tags); // Remove empty tags
        }

        // Get category name if category_id is provided
        $categoryName = null;
        if ($request->filled('category_id')) {
            $category = Category::find($request->category_id);
            $categoryName = $category ? $category->name : null;
        }

        // Prepare product data based on your database schema
        $productData = [
            'vendor_id' => $vendor->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'sku' => $validated['sku'] ?? null,
            'images' => $imagePaths,
            'tags' => $tags,
        ];

        // Add fields that might or might not exist in your database
        // Try to add category_id if the column exists
        try {
            $productData['category_id'] = $request->category_id;
        } catch (\Exception $e) {
            // If category_id doesn't exist, try using category field
            try {
                $productData['category'] = $categoryName;
            } catch (\Exception $e) {
                // Neither field exists, just skip
            }
        }

        // Try to add sale_price if the column exists
        try {
            $productData['sale_price'] = $request->sale_price;
        } catch (\Exception $e) {
            // sale_price field might not exist
        }

        // Try to add status fields
        $isActive = $request->has('is_active') ? true : false;
        try {
            $productData['is_active'] = $isActive;
        } catch (\Exception $e) {
            try {
                $productData['status'] = $isActive;
            } catch (\Exception $e) {
                // Neither field exists, just skip
            }
        }

        // Create the product
        try {
            $product = Product::create($productData);
        } catch (\Exception $e) {
            Log::error('Product creation failed: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create product: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                ->with('error', 'Failed to create product: ' . $e->getMessage())
                ->withInput();
        }

        // Update vendor's product count
        try {
            if (isset($vendor->products_count)) {
                $vendor->products_count = ($vendor->products_count ?? 0) + 1;
                $vendor->save();
            }
        } catch (\Exception $e) {
            // products_count column might not exist
            Log::warning('Could not update vendor products_count: ' . $e->getMessage());
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added successfully!',
                'product' => $product
            ]);
        }

        return redirect()->route('vendor.products.index')
            ->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified product.
     */
    public function show(string $id)
    {
        $product = Product::where('vendor_id', Auth::id())->findOrFail($id);
        
        // Get unread counts for header
        $user = Auth::user();
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
        
        return view('vendor.products.show', compact(
            'product', 
            'unreadNotificationsCount', 
            'unreadMessagesCount'
        ));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(string $id)
    {
        $product = Product::where('vendor_id', Auth::id())->findOrFail($id);
        
        $user = Auth::user();
        
        // Get categories for dropdown
        try {
            $categories = Category::where('vendor_id', $user->id)
                ->orWhere('is_global', true)
                ->get();
                
            if ($categories->isEmpty()) {
                $categories = Category::all();
            }
        } catch (QueryException $e) {
            try {
                $categories = Category::all();
            } catch (\Exception $e) {
                $categories = collect([]);
            }
        }
        
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
        
        return view('vendor.products.edit', compact(
            'product', 
            'categories', 
            'unreadNotificationsCount', 
            'unreadMessagesCount'
        ));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::where('vendor_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:50|unique:products,sku,' . $product->id,
            'description' => 'required|string|max:5000',
            'tags' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle new image uploads
        $imagePaths = $product->images ?? [];
        if ($request->hasFile('images')) {
            // Delete old images
            if ($product->images && is_array($product->images)) {
                foreach ($product->images as $oldImage) {
                    try {
                        Storage::disk('public')->delete($oldImage);
                    } catch (\Exception $e) {
                        Log::warning('Failed to delete old image: ' . $e->getMessage());
                    }
                }
            }

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                try {
                    $path = $image->store('products/' . Auth::id(), 'public');
                    $imagePaths[] = $path;
                } catch (\Exception $e) {
                    Log::error('Image upload failed during update: ' . $e->getMessage());
                }
            }
        }

        // Process tags
        $tags = $product->tags ?? [];
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $tags = array_filter($tags);
        }

        // Get category name if category_id is provided
        $categoryName = null;
        if ($request->filled('category_id')) {
            $category = Category::find($request->category_id);
            $categoryName = $category ? $category->name : null;
        }

        // Prepare update data
        $updateData = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'sku' => $validated['sku'] ?? null,
            'images' => $imagePaths,
            'tags' => $tags,
        ];

        // Add optional fields if they exist in the database
        try {
            $updateData['category_id'] = $request->category_id;
        } catch (\Exception $e) {
            try {
                $updateData['category'] = $categoryName;
            } catch (\Exception $e) {
                // Neither field exists
            }
        }

        try {
            $updateData['sale_price'] = $request->sale_price;
        } catch (\Exception $e) {
            // sale_price field might not exist
        }

        $isActive = $request->has('is_active') ? true : false;
        try {
            $updateData['is_active'] = $isActive;
        } catch (\Exception $e) {
            try {
                $updateData['status'] = $isActive;
            } catch (\Exception $e) {
                // Neither field exists
            }
        }

        try {
            $product->update($updateData);
        } catch (\Exception $e) {
            Log::error('Product update failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update product: ' . $e->getMessage())
                ->withInput();
        }

        return redirect()->route('vendor.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('vendor_id', Auth::id())->findOrFail($id);

        // Delete product images
        if ($product->images && is_array($product->images)) {
            foreach ($product->images as $image) {
                try {
                    Storage::disk('public')->delete($image);
                } catch (\Exception $e) {
                    Log::warning('Failed to delete image: ' . $e->getMessage());
                }
            }
        }

        try {
            $product->delete();
        } catch (\Exception $e) {
            Log::error('Product deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete product');
        }

        // Update vendor's product count
        try {
            $vendor = Auth::user();
            if (isset($vendor->products_count)) {
                $vendor->products_count = max(0, ($vendor->products_count ?? 1) - 1);
                $vendor->save();
            }
        } catch (\Exception $e) {
            // products_count column might not exist
            Log::warning('Could not update vendor products_count: ' . $e->getMessage());
        }

        return redirect()->route('vendor.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Activate a product
     */
    public function activate(string $id)
    {
        $product = Product::where('vendor_id', Auth::id())->findOrFail($id);
        
        try {
            try {
                $product->is_active = true;
            } catch (\Exception $e) {
                $product->status = true;
            }
            $product->save();
        } catch (\Exception $e) {
            Log::error('Product activation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to activate product');
        }

        return redirect()->back()->with('success', 'Product activated successfully!');
    }

    /**
     * Deactivate a product
     */
    public function deactivate(string $id)
    {
        $product = Product::where('vendor_id', Auth::id())->findOrFail($id);
        
        try {
            try {
                $product->is_active = false;
            } catch (\Exception $e) {
                $product->status = false;
            }
            $product->save();
        } catch (\Exception $e) {
            Log::error('Product deactivation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to deactivate product');
        }

        return redirect()->back()->with('success', 'Product deactivated successfully!');
    }

    /**
     * Bulk activate products
     */
    public function bulkActivate(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id'
        ]);

        try {
            $products = Product::whereIn('id', $request->product_ids)
                ->where('vendor_id', Auth::id())
                ->get();

            foreach ($products as $product) {
                try {
                    $product->is_active = true;
                } catch (\Exception $e) {
                    $product->status = true;
                }
                $product->save();
            }

            return response()->json([
                'success' => true,
                'message' => count($products) . ' products activated successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Bulk activation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to activate products: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk deactivate products
     */
    public function bulkDeactivate(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id'
        ]);

        try {
            $products = Product::whereIn('id', $request->product_ids)
                ->where('vendor_id', Auth::id())
                ->get();

            foreach ($products as $product) {
                try {
                    $product->is_active = false;
                } catch (\Exception $e) {
                    $product->status = false;
                }
                $product->save();
            }

            return response()->json([
                'success' => true,
                'message' => count($products) . ' products deactivated successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Bulk deactivation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to deactivate products: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete products
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id'
        ]);

        try {
            $products = Product::whereIn('id', $request->product_ids)
                ->where('vendor_id', Auth::id())
                ->get();

            foreach ($products as $product) {
                // Delete product images
                if ($product->images && is_array($product->images)) {
                    foreach ($product->images as $image) {
                        try {
                            Storage::disk('public')->delete($image);
                        } catch (\Exception $e) {
                            Log::warning('Failed to delete image during bulk delete: ' . $e->getMessage());
                        }
                    }
                }
                $product->delete();
            }

            return response()->json([
                'success' => true,
                'message' => count($products) . ' products deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Bulk delete failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete products: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle product status (active/inactive)
     */
    public function toggleStatus(string $id)
    {
        $product = Product::where('vendor_id', Auth::id())->findOrFail($id);
        
        try {
            try {
                $product->is_active = !$product->is_active;
                $status = $product->is_active;
            } catch (\Exception $e) {
                $product->status = !$product->status;
                $status = $product->status;
            }
            $product->save();
        } catch (\Exception $e) {
            Log::error('Toggle status failed: ' . $e->getMessage());
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to toggle product status'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to toggle product status');
        }

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'status' => $status
            ]);
        }

        return redirect()->back()->with('success', 'Product status updated!');
    }

    /**
     * Get vendor products for AJAX
     */
    public function getVendorProducts()
    {
        try {
            $vendor = Auth::user();
            $products = Product::where('vendor_id', $vendor->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'products' => $products
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to get vendor products: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch products'
            ], 500);
        }
    }
}