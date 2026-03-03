<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\PromotionUsage;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    /**
     * Display a listing of promotions.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        try {
            $query = Promotion::with(['creator', 'categories', 'products'])
                ->withCount('usages');
            
            // Apply status filter
            $status = $request->get('status');
            $now = now();
            
            if ($status === 'active') {
                $query->where('is_active', true)
                    ->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
            } elseif ($status === 'upcoming') {
                $query->where('is_active', true)
                    ->where('start_date', '>', $now);
            } elseif ($status === 'expired') {
                $query->where('end_date', '<', $now);
            }
            
            // Apply search filter
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%");
                });
            }
            
            $promotions = $query->orderBy('created_at', 'desc')->paginate(15);
            
            // Calculate stats for the dashboard cards
            $activeCount = Promotion::where('is_active', true)
                ->where('start_date', '<=', $now)
                ->where('end_date', '>=', $now)
                ->count();
                
            $upcomingCount = Promotion::where('is_active', true)
                ->where('start_date', '>', $now)
                ->count();
                
            $expiredCount = Promotion::where('end_date', '<', $now)->count();

            // Get unread notifications count
            $unreadNotificationsCount = 0;
            $unreadMessagesCount = 0;
            
            try {
                if (class_exists('App\Models\Notification')) {
                    $unreadNotificationsCount = \App\Models\Notification::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            } catch (\Exception $e) {
                Log::warning('Notifications table might not exist: ' . $e->getMessage());
            }

            try {
                if (class_exists('App\Models\Message')) {
                    $unreadMessagesCount = \App\Models\Message::where('receiver_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            } catch (\Exception $e) {
                Log::warning('Messages table might not exist: ' . $e->getMessage());
            }

            return view('admin.promotions.index', compact(
                'promotions', 
                'user',
                'unreadNotificationsCount',
                'unreadMessagesCount',
                'activeCount',
                'upcomingCount',
                'expiredCount'
            ));
            
        } catch (\Exception $e) {
            Log::error('Failed to load promotions: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load promotions.');
        }
    }

    /**
     * Show the form for creating a new promotion.
     */
    public function create()
    {
        $user = Auth::user();
        
        try {
            // Get categories with error handling
            try {
                $categories = Category::orderBy('name')->get();
            } catch (\Exception $e) {
                Log::warning('Categories query failed: ' . $e->getMessage());
                $categories = collect([]);
            }

            // Get products with error handling
            try {
                $products = Product::select('id', 'name', 'price', 'stock', 'image', 'category_id')
                    ->orderBy('name')
                    ->limit(500)
                    ->get();
            } catch (\Exception $e) {
                Log::warning('Products query failed: ' . $e->getMessage());
                $products = collect([]);
            }

            // Get unread counts with error handling
            $unreadNotificationsCount = 0;
            $unreadMessagesCount = 0;
            
            try {
                if (class_exists('App\Models\Notification')) {
                    $unreadNotificationsCount = \App\Models\Notification::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            } catch (\Exception $e) {
                Log::warning('Notifications query failed: ' . $e->getMessage());
            }

            try {
                if (class_exists('App\Models\Message')) {
                    $unreadMessagesCount = \App\Models\Message::where('receiver_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            } catch (\Exception $e) {
                Log::warning('Messages query failed: ' . $e->getMessage());
            }

            return view('admin.promotions.create', compact(
                'categories', 
                'products', 
                'user',
                'unreadNotificationsCount',
                'unreadMessagesCount'
            ));
            
        } catch (\Exception $e) {
            Log::error('Failed to load create form: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return with empty collections
            return view('admin.promotions.create', [
                'categories' => collect([]),
                'products' => collect([]),
                'user' => $user,
                'unreadNotificationsCount' => 0,
                'unreadMessagesCount' => 0
            ])->with('warning', 'Some data could not be loaded. The form may have limited functionality.');
        }
    }

    /**
     * Store a newly created promotion in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request - MATCHING YOUR MODEL STRUCTURE
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|unique:promotions,code|max:50',
                'type' => 'required|in:percentage,fixed,bogo,free_shipping',
                'description' => 'nullable|string',
                'terms_conditions' => 'nullable|string',
                'discount_percentage' => 'required_if:type,percentage|nullable|numeric|min:1|max:100',
                'discount_amount' => 'required_if:type,fixed|nullable|numeric|min:1',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'min_purchase' => 'nullable|numeric|min:0',
                'max_discount' => 'nullable|numeric|min:0',
                'usage_limit_per_user' => 'nullable|integer|min:0',
                'total_usage_limit' => 'nullable|integer|min:0',
                'is_active' => 'required|in:0,1',
                'product_scope' => 'required|in:all,selected,categories',
                'products' => 'required_if:product_scope,selected|array',
                'products.*' => 'exists:products,id',
                'categories' => 'required_if:product_scope,categories|array',
                'categories.*' => 'exists:categories,id',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            DB::beginTransaction();

            // Handle banner upload
            $bannerPath = null;
            if ($request->hasFile('banner')) {
                $bannerPath = $request->file('banner')->store('promotions', 'public');
            }

            // Determine the value based on type
            $value = null;
            if ($validated['type'] === 'percentage') {
                $value = $validated['discount_percentage'];
            } elseif ($validated['type'] === 'fixed') {
                $value = $validated['discount_amount'];
            }

            // Prepare data for creation - MATCHING YOUR MODEL FIELDS
            $data = [
                'name' => $validated['name'],
                'code' => strtoupper($validated['code']),
                'type' => $validated['type'],
                'value' => $value,
                'description' => $validated['description'] ?? null,
                'terms_conditions' => $validated['terms_conditions'] ?? null,
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'] ?? null,
                'min_purchase' => $validated['min_purchase'] ?? 0,
                'max_discount' => $validated['max_discount'] ?? null,
                'usage_limit_per_user' => $validated['usage_limit_per_user'] ?? 1,
                'total_usage_limit' => $validated['total_usage_limit'] ?? null,
                'used_count' => 0,
                'product_scope' => $validated['product_scope'],
                'banner' => $bannerPath,
                'is_active' => $validated['is_active'],
                'created_by' => Auth::id(),
            ];

            // Create promotion
            $promotion = Promotion::create($data);

            // Attach products if selected
            if ($validated['product_scope'] === 'selected' && !empty($validated['products'])) {
                $promotion->products()->attach($validated['products']);
            }

            // Attach categories if selected
            if ($validated['product_scope'] === 'categories' && !empty($validated['categories'])) {
                $promotion->categories()->attach($validated['categories']);
            }

            DB::commit();

            return redirect()->route('admin.promotions.promotions')
                ->with('success', 'Promotion created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to create promotion: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['_token', 'banner'])
            ]);

            if (isset($bannerPath) && Storage::disk('public')->exists($bannerPath)) {
                Storage::disk('public')->delete($bannerPath);
            }

            return redirect()->back()
                ->with('error', 'Failed to create promotion. ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified promotion.
     */
    public function show($id)
    {
        $user = Auth::user();
        
        try {
            $promotion = Promotion::with(['creator', 'categories', 'products', 'usages.user'])
                ->withCount('usages')
                ->findOrFail($id);

            $recentUsages = $promotion->usages()
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->limit(20)
                ->get();

            $unreadNotificationsCount = 0;
            $unreadMessagesCount = 0;
            
            try {
                if (class_exists('App\Models\Notification')) {
                    $unreadNotificationsCount = \App\Models\Notification::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            } catch (\Exception $e) {}

            try {
                if (class_exists('App\Models\Message')) {
                    $unreadMessagesCount = \App\Models\Message::where('receiver_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            } catch (\Exception $e) {}

            return view('admin.promotions.show', compact(
                'promotion', 
                'recentUsages',
                'user',
                'unreadNotificationsCount',
                'unreadMessagesCount'
            ));
            
        } catch (\Exception $e) {
            Log::error('Failed to load promotion: ' . $e->getMessage());
            return redirect()->route('admin.promotions.promotions')
                ->with('error', 'Promotion not found.');
        }
    }

    /**
     * Show the form for editing the specified promotion.
     */
    public function edit($id)
    {
        $user = Auth::user();
        
        try {
            $promotion = Promotion::with(['products', 'categories'])->findOrFail($id);
            
            try {
                $categories = Category::orderBy('name')->get();
            } catch (\Exception $e) {
                Log::warning('Categories query failed in edit: ' . $e->getMessage());
                $categories = collect([]);
            }
            
            try {
                $products = Product::select('id', 'name', 'price', 'stock', 'image', 'category_id')
                    ->orderBy('name')
                    ->limit(500)
                    ->get();
            } catch (\Exception $e) {
                Log::warning('Products query failed in edit: ' . $e->getMessage());
                $products = collect([]);
            }

            $selectedProducts = $promotion->products->pluck('id')->toArray();
            $selectedCategories = $promotion->categories->pluck('id')->toArray();

            $unreadNotificationsCount = 0;
            $unreadMessagesCount = 0;
            
            try {
                if (class_exists('App\Models\Notification')) {
                    $unreadNotificationsCount = \App\Models\Notification::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            } catch (\Exception $e) {}

            try {
                if (class_exists('App\Models\Message')) {
                    $unreadMessagesCount = \App\Models\Message::where('receiver_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            } catch (\Exception $e) {}

            return view('admin.promotions.edit', compact(
                'promotion',
                'categories',
                'products',
                'selectedProducts',
                'selectedCategories',
                'user',
                'unreadNotificationsCount',
                'unreadMessagesCount'
            ));
            
        } catch (\Exception $e) {
            Log::error('Failed to load edit form: ' . $e->getMessage());
            return redirect()->route('admin.promotions.promotions')
                ->with('error', 'Promotion not found.');
        }
    }

    /**
     * Update the specified promotion.
     */
    public function update(Request $request, $id)
    {
        try {
            $promotion = Promotion::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|unique:promotions,code,' . $id . '|max:50',
                'type' => 'required|in:percentage,fixed,bogo,free_shipping',
                'description' => 'nullable|string',
                'terms_conditions' => 'nullable|string',
                'discount_percentage' => 'required_if:type,percentage|nullable|numeric|min:1|max:100',
                'discount_amount' => 'required_if:type,fixed|nullable|numeric|min:1',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'min_purchase' => 'nullable|numeric|min:0',
                'max_discount' => 'nullable|numeric|min:0',
                'usage_limit_per_user' => 'nullable|integer|min:0',
                'total_usage_limit' => 'nullable|integer|min:0',
                'is_active' => 'required|in:0,1',
                'product_scope' => 'required|in:all,selected,categories',
                'products' => 'required_if:product_scope,selected|array',
                'products.*' => 'exists:products,id',
                'categories' => 'required_if:product_scope,categories|array',
                'categories.*' => 'exists:categories,id',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            DB::beginTransaction();

            if ($request->hasFile('banner')) {
                if ($promotion->banner && Storage::disk('public')->exists($promotion->banner)) {
                    Storage::disk('public')->delete($promotion->banner);
                }
                
                $bannerPath = $request->file('banner')->store('promotions', 'public');
                $promotion->banner = $bannerPath;
            }

            if ($validated['type'] === 'percentage') {
                $promotion->value = $validated['discount_percentage'];
            } elseif ($validated['type'] === 'fixed') {
                $promotion->value = $validated['discount_amount'];
            } else {
                $promotion->value = null;
            }

            $promotion->name = $validated['name'];
            $promotion->code = strtoupper($validated['code']);
            $promotion->type = $validated['type'];
            $promotion->description = $validated['description'] ?? null;
            $promotion->terms_conditions = $validated['terms_conditions'] ?? null;
            $promotion->start_date = $validated['start_date'];
            $promotion->end_date = $validated['end_date'] ?? null;
            $promotion->min_purchase = $validated['min_purchase'] ?? 0;
            $promotion->max_discount = $validated['max_discount'] ?? null;
            $promotion->usage_limit_per_user = $validated['usage_limit_per_user'] ?? 1;
            $promotion->total_usage_limit = $validated['total_usage_limit'] ?? null;
            $promotion->product_scope = $validated['product_scope'];
            $promotion->is_active = $validated['is_active'];
            
            $promotion->save();

            if ($validated['product_scope'] === 'selected') {
                $promotion->products()->sync($validated['products'] ?? []);
                $promotion->categories()->sync([]);
            } elseif ($validated['product_scope'] === 'categories') {
                $promotion->categories()->sync($validated['categories'] ?? []);
                $promotion->products()->sync([]);
            } else {
                $promotion->products()->sync([]);
                $promotion->categories()->sync([]);
            }

            DB::commit();

            return redirect()->route('admin.promotions.promotions')
                ->with('success', 'Promotion updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Failed to update promotion: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            
            return redirect()->back()
                ->with('error', 'Failed to update promotion: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified promotion.
     */
    public function destroy($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);
            
            DB::beginTransaction();
            
            if ($promotion->banner && Storage::disk('public')->exists($promotion->banner)) {
                Storage::disk('public')->delete($promotion->banner);
            }
            
            $promotion->products()->detach();
            $promotion->categories()->detach();
            $promotion->usages()->delete();
            $promotion->delete();
            
            DB::commit();
            
            return redirect()->route('admin.promotions.promotions')
                ->with('success', 'Promotion deleted successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Failed to delete promotion: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            
            return redirect()->back()
                ->with('error', 'Failed to delete promotion: ' . $e->getMessage());
        }
    }

    /**
     * Get products list for AJAX request.
     */
    public function getProductsList(Request $request)
    {
        try {
            $search = $request->get('search', '');
            
            $query = Product::select('id', 'name', 'price', 'stock', 'image', 'category_id');
            
            if ($search) {
                $query->where('name', 'like', "%{$search}%");
            }
            
            $products = $query->orderBy('name')
                ->limit(500)
                ->get()
                ->map(function($product) {
                    $categoryName = 'Uncategorized';
                    if ($product->category_id) {
                        try {
                            $category = Category::find($product->category_id);
                            $categoryName = $category ? $category->name : 'Uncategorized';
                        } catch (\Exception $e) {
                            $categoryName = 'Uncategorized';
                        }
                    }
                    
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'stock' => $product->stock,
                        'image' => $product->image ? Storage::url($product->image) : null,
                        'category' => $categoryName
                    ];
                });

            return response()->json([
                'success' => true,
                'products' => $products
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to load products'
            ], 500);
        }
    }

    /**
     * Toggle promotion status.
     */
    public function toggleStatus($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);
            $promotion->is_active = !$promotion->is_active;
            $promotion->save();

            return response()->json([
                'success' => true,
                'is_active' => $promotion->is_active,
                'message' => 'Promotion status updated successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to toggle promotion status: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update promotion status.'
            ], 500);
        }
    }

    /**
     * Duplicate a promotion.
     */
    public function duplicate($id)
    {
        try {
            $originalPromotion = Promotion::with(['products', 'categories'])->findOrFail($id);
            
            DB::beginTransaction();
            
            $newPromotion = $originalPromotion->replicate();
            $newPromotion->name = $originalPromotion->name . ' (Copy)';
            $newPromotion->code = $originalPromotion->code . '_COPY_' . rand(100, 999);
            $newPromotion->used_count = 0;
            $newPromotion->created_by = Auth::id();
            $newPromotion->created_at = now();
            $newPromotion->updated_at = now();
            
            if ($originalPromotion->banner && Storage::disk('public')->exists($originalPromotion->banner)) {
                $extension = pathinfo($originalPromotion->banner, PATHINFO_EXTENSION);
                $newPath = 'promotions/' . uniqid() . '.' . $extension;
                Storage::disk('public')->copy($originalPromotion->banner, $newPath);
                $newPromotion->banner = $newPath;
            }
            
            $newPromotion->save();
            
            $newPromotion->products()->sync($originalPromotion->products->pluck('id'));
            $newPromotion->categories()->sync($originalPromotion->categories->pluck('id'));
            
            DB::commit();
            
            return redirect()->route('admin.promotions.edit', $newPromotion->id)
                ->with('success', 'Promotion duplicated successfully. You are now editing the copy.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Failed to duplicate promotion: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            
            return redirect()->route('admin.promotions.promotions')
                ->with('error', 'Failed to duplicate promotion.');
        }
    }

    /**
     * Export promotions to CSV.
     */
    public function export(Request $request)
    {
        try {
            $promotions = Promotion::withCount('usages')
                ->orderBy('created_at', 'desc')
                ->get();

            $filename = 'promotions-' . now()->format('Y-m-d') . '.csv';
            
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ];

            $callback = function() use ($promotions) {
                $handle = fopen('php://output', 'w');
                
                fputcsv($handle, [
                    'ID',
                    'Name',
                    'Code',
                    'Type',
                    'Value',
                    'Start Date',
                    'End Date',
                    'Min Purchase',
                    'Max Discount',
                    'Usage Limit/User',
                    'Total Usage Limit',
                    'Used Count',
                    'Product Scope',
                    'Status',
                    'Created At'
                ]);

                foreach ($promotions as $promotion) {
                    fputcsv($handle, [
                        $promotion->id,
                        $promotion->name,
                        $promotion->code,
                        $promotion->type,
                        $promotion->type === 'percentage' ? $promotion->value . '%' : 'ETB ' . number_format($promotion->value, 2),
                        $promotion->start_date ? $promotion->start_date->format('Y-m-d H:i') : 'N/A',
                        $promotion->end_date ? $promotion->end_date->format('Y-m-d H:i') : 'Never',
                        'ETB ' . number_format($promotion->min_purchase, 2),
                        $promotion->max_discount ? 'ETB ' . number_format($promotion->max_discount, 2) : 'Unlimited',
                        $promotion->usage_limit_per_user ?? 'Unlimited',
                        $promotion->total_usage_limit ?? 'Unlimited',
                        $promotion->usages_count,
                        ucfirst($promotion->product_scope),
                        $promotion->is_active ? 'Active' : 'Inactive',
                        $promotion->created_at->format('Y-m-d H:i')
                    ]);
                }

                fclose($handle);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error('Failed to export promotions: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to export promotions.');
        }
    }

    /**
     * Bulk delete promotions.
     */
    public function bulkDelete(Request $request)
    {
        try {
            $request->validate([
                'promotion_ids' => 'required|array',
                'promotion_ids.*' => 'exists:promotions,id'
            ]);

            DB::beginTransaction();

            foreach ($request->promotion_ids as $id) {
                $promotion = Promotion::find($id);
                if ($promotion) {
                    if ($promotion->banner && Storage::disk('public')->exists($promotion->banner)) {
                        Storage::disk('public')->delete($promotion->banner);
                    }
                    
                    $promotion->products()->detach();
                    $promotion->categories()->detach();
                    $promotion->usages()->delete();
                    $promotion->delete();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => count($request->promotion_ids) . ' promotions deleted successfully.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Failed to bulk delete promotions: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete promotions.'
            ], 500);
        }
    }

    /**
     * Bulk activate promotions.
     */
    public function bulkActivate(Request $request)
    {
        try {
            $request->validate([
                'promotion_ids' => 'required|array',
                'promotion_ids.*' => 'exists:promotions,id'
            ]);

            Promotion::whereIn('id', $request->promotion_ids)
                ->update(['is_active' => true]);

            return response()->json([
                'success' => true,
                'message' => count($request->promotion_ids) . ' promotions activated successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to bulk activate promotions: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to activate promotions.'
            ], 500);
        }
    }

    /**
     * Bulk deactivate promotions.
     */
    public function bulkDeactivate(Request $request)
    {
        try {
            $request->validate([
                'promotion_ids' => 'required|array',
                'promotion_ids.*' => 'exists:promotions,id'
            ]);

            Promotion::whereIn('id', $request->promotion_ids)
                ->update(['is_active' => false]);

            return response()->json([
                'success' => true,
                'message' => count($request->promotion_ids) . ' promotions deactivated successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to bulk deactivate promotions: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to deactivate promotions.'
            ], 500);
        }
    }
}