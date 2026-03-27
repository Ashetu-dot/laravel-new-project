<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display customer coupons page.
     */
    public function customerCoupons(Request $request)
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

        // Get coupons for the customer
        $query = Coupon::where(function($q) use ($user) {
                $q->whereNull('user_id') // Global coupons
                  ->orWhere('user_id', $user->id); // User-specific coupons
            })
            ->where('is_active', true)
            ->withCount('usages');

        // Filter by status
        switch($request->get('filter', 'active')) {
            case 'active':
                $query->where('expires_at', '>', now())
                      ->where(function($q) {
                          $q->whereNull('max_uses')
                            ->orWhere('used_count', '<', DB::raw('max_uses'));
                      });
                break;
            case 'expired':
                $query->where('expires_at', '<=', now());
                break;
            case 'used':
                $query->whereHas('usages', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
                break;
        }

        // Search by code or description
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $coupons = $query->orderBy('created_at', 'desc')->paginate(12);

        // Calculate statistics
        $activeCoupons = Coupon::where(function($q) use ($user) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', $user->id);
            })
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->count();

        $totalSavings = CouponUsage::where('user_id', $user->id)
            ->sum('discount_amount');

        $usedCoupons = CouponUsage::where('user_id', $user->id)->count();

        $expiringSoon = Coupon::where(function($q) use ($user) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', $user->id);
            })
            ->where('is_active', true)
            ->whereBetween('expires_at', [now(), now()->addDays(7)])
            ->count();

        // Get cart count
        try {
            $cartCount = \App\Models\Cart::where('user_id', $user->id)->sum('quantity');
        } catch (\Exception $e) {
            $cartCount = 0;
        }

        return view('customer.coupons', compact(
            'user',
            'coupons',
            'activeCoupons',
            'totalSavings',
            'usedCoupons',
            'expiringSoon',
            'unreadNotificationsCount',
            'unreadMessagesCount',
            'cartCount'
        ));
    }

    /**
     * Display coupon details.
     */
    public function show($id)
    {
        $user = Auth::user();

        $coupon = Coupon::where('id', $id)
            ->where(function($q) use ($user) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', $user->id);
            })
            ->withCount('usages')
            ->firstOrFail();

        // Check if user can use this coupon
        $canUse = $this->canUseCoupon($coupon, $user);

        return view('coupons.show', compact('coupon', 'canUse'));
    }

    /**
     * Redeem a coupon.
     */
    public function redeem(Request $request, $id)
    {
        try {
            $user = Auth::user();
            $coupon = Coupon::where('id', $id)
                ->where(function($q) use ($user) {
                    $q->whereNull('user_id')
                      ->orWhere('user_id', $user->id);
                })
                ->where('is_active', true)
                ->firstOrFail();

            // Validate coupon usage
            $validation = $this->validateCoupon($coupon, $user);
            if (!$validation['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => $validation['message']
                ], 400);
            }

            DB::beginTransaction();

            try {
                // Create usage record
                $usage = CouponUsage::create([
                    'coupon_id' => $coupon->id,
                    'user_id' => $user->id,
                    'discount_amount' => $this->calculateDiscount($coupon, $request->input('order_amount', 0)),
                    'order_id' => $request->input('order_id'),
                    'metadata' => json_encode($request->except('_token'))
                ]);

                // Update coupon usage count
                $coupon->increment('used_count');

                // Create notification for user
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'coupon_redeemed',
                    'title' => 'Coupon Redeemed',
                    'message' => 'You have successfully redeemed coupon: ' . $coupon->code,
                    'data' => json_encode(['coupon_id' => $coupon->id, 'code' => $coupon->code]),
                    'is_read' => false,
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Coupon redeemed successfully',
                    'discount' => $usage->discount_amount,
                    'code' => $coupon->code
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Coupon redemption error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to redeem coupon'
            ], 500);
        }
    }

    /**
     * Apply coupon to cart.
     */
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'order_amount' => 'required|numeric|min:0'
        ]);

        try {
            $user = Auth::user();

            // Find coupon by code
            $coupon = Coupon::where('code', $request->code)
                ->where('is_active', true)
                ->first();

            if (!$coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon code'
                ], 404);
            }

            // Validate coupon
            $validation = $this->validateCoupon($coupon, $user, $request->order_amount);
            if (!$validation['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => $validation['message']
                ], 400);
            }

            // Calculate discount
            $discount = $this->calculateDiscount($coupon, $request->order_amount);

            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully',
                'coupon' => [
                    'id' => $coupon->id,
                    'code' => $coupon->code,
                    'discount' => $discount,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'description' => $coupon->description
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Coupon apply error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error applying coupon'
            ], 500);
        }
    }

    /**
     * Get coupons for a specific vendor.
     */
    public function vendorCoupons($vendorId)
    {
        try {
            $coupons = Coupon::where('vendor_id', $vendorId)
                ->where('is_active', true)
                ->where('expires_at', '>', now())
                ->where(function($q) {
                    $q->whereNull('max_uses')
                      ->orWhere('used_count', '<', DB::raw('max_uses'));
                })
                ->get();

            return response()->json([
                'success' => true,
                'data' => $coupons
            ]);

        } catch (\Exception $e) {
            Log::error('Vendor coupons error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch vendor coupons'
            ], 500);
        }
    }

    /**
     * Admin index - list all coupons.
     */
    public function adminIndex(Request $request)
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

        $query = Coupon::with(['creator', 'vendor']);

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            switch($request->status) {
                case 'active':
                    $query->where('is_active', true)
                          ->where('expires_at', '>', now());
                    break;
                case 'expired':
                    $query->where('expires_at', '<=', now());
                    break;
                case 'inactive':
                    $query->where('is_active', false);
                    break;
            }
        }

        // Filter by type
        if ($request->has('type') && !empty($request->type)) {
            $query->where('type', $request->type);
        }

        $coupons = $query->orderBy('created_at', 'desc')->paginate(20);

        $stats = [
            'total' => Coupon::count(),
            'active' => Coupon::where('is_active', true)->where('expires_at', '>', now())->count(),
            'expired' => Coupon::where('expires_at', '<=', now())->count(),
            'total_uses' => CouponUsage::count()
        ];

        return view('admin.coupons.index', compact(
            'user',
            'coupons',
            'stats',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Show coupon creation form.
     */
    public function create()
    {
        $user = Auth::user();
        $vendors = User::where('role', 'vendor')->where('is_active', true)->get();

        return view('admin.coupons.create', compact('user', 'vendors'));
    }

    /**
     * Store a newly created coupon.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:coupons,code|max:50',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'expires_at' => 'required|date|after:now',
            'max_uses' => 'nullable|integer|min:1',
            'per_user_limit' => 'nullable|integer|min:1',
            'vendor_id' => 'nullable|exists:users,id',
            'user_id' => 'nullable|exists:users,id',
            'is_active' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $coupon = Coupon::create([
                'code' => strtoupper($request->code),
                'type' => $request->type,
                'value' => $request->value,
                'description' => $request->description,
                'min_order_amount' => $request->min_order_amount,
                'max_discount_amount' => $request->max_discount_amount,
                'expires_at' => $request->expires_at,
                'max_uses' => $request->max_uses,
                'per_user_limit' => $request->per_user_limit,
                'vendor_id' => $request->vendor_id,
                'user_id' => $request->user_id,
                'created_by' => Auth::id(),
                'is_active' => $request->has('is_active'),
            ]);

            Log::info('Coupon created', [
                'coupon_id' => $coupon->id,
                'code' => $coupon->code,
                'created_by' => Auth::id()
            ]);

            return redirect()->route('admin.coupons')
                ->with('success', 'Coupon created successfully.');

        } catch (\Exception $e) {
            Log::error('Coupon creation error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to create coupon.')
                ->withInput();
        }
    }

    /**
     * Show coupon edit form.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $coupon = Coupon::findOrFail($id);
        $vendors = User::where('role', 'vendor')->where('is_active', true)->get();

        return view('admin.coupons.edit', compact('user', 'coupon', 'vendors'));
    }

    /**
     * Update the specified coupon.
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:coupons,code,' . $id . '|max:50',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'expires_at' => 'required|date',
            'max_uses' => 'nullable|integer|min:1',
            'per_user_limit' => 'nullable|integer|min:1',
            'vendor_id' => 'nullable|exists:users,id',
            'user_id' => 'nullable|exists:users,id',
            'is_active' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $coupon->update([
                'code' => strtoupper($request->code),
                'type' => $request->type,
                'value' => $request->value,
                'description' => $request->description,
                'min_order_amount' => $request->min_order_amount,
                'max_discount_amount' => $request->max_discount_amount,
                'expires_at' => $request->expires_at,
                'max_uses' => $request->max_uses,
                'per_user_limit' => $request->per_user_limit,
                'vendor_id' => $request->vendor_id,
                'user_id' => $request->user_id,
                'is_active' => $request->has('is_active'),
            ]);

            Log::info('Coupon updated', [
                'coupon_id' => $coupon->id,
                'code' => $coupon->code,
                'updated_by' => Auth::id()
            ]);

            return redirect()->route('admin.coupons')
                ->with('success', 'Coupon updated successfully.');

        } catch (\Exception $e) {
            Log::error('Coupon update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update coupon.')
                ->withInput();
        }
    }

    /**
     * Generate a new coupon code.
     */
    public function generate(Request $request)
    {
        try {
            $request->validate([
                'prefix' => 'nullable|string|max:10',
                'suffix' => 'nullable|string|max:10',
                'length' => 'nullable|integer|min:4|max:20'
            ]);

            $code = $this->generateCouponCode(
                $request->prefix ?? '',
                $request->suffix ?? '',
                $request->length ?? 8
            );

            return response()->json([
                'success' => true,
                'code' => $code
            ]);

        } catch (\Exception $e) {
            Log::error('Coupon generation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate coupon code'
            ], 500);
        }
    }

    /**
     * Toggle coupon status.
     */
    public function toggleStatus($id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->is_active = !$coupon->is_active;
            $coupon->save();

            return response()->json([
                'success' => true,
                'is_active' => $coupon->is_active,
                'message' => 'Coupon status updated successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Coupon status toggle error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update coupon status'
            ], 500);
        }
    }

    /**
     * Delete the specified coupon.
     */
    public function adminDelete($id)
    {
        try {
            $coupon = Coupon::findOrFail($id);

            // Check if coupon has been used
            $usageCount = CouponUsage::where('coupon_id', $id)->count();
            if ($usageCount > 0) {
                return redirect()->back()
                    ->with('error', 'Cannot delete coupon that has been used.');
            }

            $coupon->delete();

            Log::info('Coupon deleted', [
                'coupon_id' => $id,
                'deleted_by' => Auth::id()
            ]);

            return redirect()->route('admin.coupons')
                ->with('success', 'Coupon deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Coupon deletion error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to delete coupon.');
        }
    }

    /**
     * Bulk delete coupons.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'coupon_ids' => 'required|array',
            'coupon_ids.*' => 'exists:coupons,id'
        ]);

        try {
            // Check if any coupons have been used
            $usedCoupons = CouponUsage::whereIn('coupon_id', $request->coupon_ids)
                ->distinct('coupon_id')
                ->count('coupon_id');

            if ($usedCoupons > 0) {
                return response()->json([
                    'success' => false,
                    'message' => $usedCoupons . ' coupon(s) have been used and cannot be deleted.'
                ], 400);
            }

            Coupon::whereIn('id', $request->coupon_ids)->delete();

            return response()->json([
                'success' => true,
                'message' => count($request->coupon_ids) . ' coupons deleted successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Bulk coupon deletion error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete coupons'
            ], 500);
        }
    }

    /**
     * Export coupons to CSV.
     */
    public function export(Request $request)
    {
        $query = Coupon::with(['creator', 'vendor']);

        // Apply filters
        if ($request->has('status') && !empty($request->status)) {
            switch($request->status) {
                case 'active':
                    $query->where('is_active', true)
                          ->where('expires_at', '>', now());
                    break;
                case 'expired':
                    $query->where('expires_at', '<=', now());
                    break;
                case 'inactive':
                    $query->where('is_active', false);
                    break;
            }
        }

        $coupons = $query->get();

        $filename = "coupons-export-" . date('Y-m-d-His') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($coupons) {
            $file = fopen('php://output', 'w');

            // Add UTF-8 BOM
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Headers
            fputcsv($file, [
                'ID',
                'Code',
                'Type',
                'Value',
                'Description',
                'Min Order',
                'Max Discount',
                'Expires At',
                'Max Uses',
                'Used Count',
                'Per User Limit',
                'Status',
                'Created By',
                'Vendor',
                'Created At'
            ]);

            foreach ($coupons as $coupon) {
                fputcsv($file, [
                    $coupon->id,
                    $coupon->code,
                    $coupon->type,
                    $coupon->value,
                    $coupon->description,
                    $coupon->min_order_amount,
                    $coupon->max_discount_amount,
                    $coupon->expires_at->format('Y-m-d H:i:s'),
                    $coupon->max_uses,
                    $coupon->used_count,
                    $coupon->per_user_limit,
                    $coupon->is_active ? 'Active' : 'Inactive',
                    $coupon->creator->name ?? 'N/A',
                    $coupon->vendor->business_name ?? 'N/A',
                    $coupon->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get coupon statistics.
     */
    public function getStats()
    {
        try {
            $stats = [
                'total' => Coupon::count(),
                'active' => Coupon::where('is_active', true)
                    ->where('expires_at', '>', now())
                    ->count(),
                'expired' => Coupon::where('expires_at', '<=', now())->count(),
                'used' => Coupon::where('used_count', '>', 0)->count(),
                'total_uses' => CouponUsage::count(),
                'total_discount' => CouponUsage::sum('discount_amount'),
                'avg_discount' => CouponUsage::avg('discount_amount') ?? 0,
                'popular_coupons' => Coupon::withCount('usages')
                    ->orderBy('usages_count', 'desc')
                    ->limit(5)
                    ->get()
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Coupon stats error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch coupon statistics'
            ], 500);
        }
    }

    /**
     * Validate if a coupon can be used.
     */
    private function validateCoupon($coupon, $user, $orderAmount = 0)
    {
        // Check if coupon is active
        if (!$coupon->is_active) {
            return ['valid' => false, 'message' => 'Coupon is not active'];
        }

        // Check if coupon is expired
        if ($coupon->expires_at && $coupon->expires_at <= now()) {
            return ['valid' => false, 'message' => 'Coupon has expired'];
        }

        // Check max uses
        if ($coupon->max_uses && $coupon->used_count >= $coupon->max_uses) {
            return ['valid' => false, 'message' => 'Coupon usage limit has been reached'];
        }

        // Check per user limit
        if ($coupon->per_user_limit) {
            $userUsage = CouponUsage::where('coupon_id', $coupon->id)
                ->where('user_id', $user->id)
                ->count();

            if ($userUsage >= $coupon->per_user_limit) {
                return ['valid' => false, 'message' => 'You have reached the usage limit for this coupon'];
            }
        }

        // Check minimum order amount
        if ($coupon->min_order_amount && $orderAmount < $coupon->min_order_amount) {
            return ['valid' => false, 'message' => 'Minimum order amount not met'];
        }

        // Check if coupon is for specific user
        if ($coupon->user_id && $coupon->user_id != $user->id) {
            return ['valid' => false, 'message' => 'This coupon is not valid for your account'];
        }

        return ['valid' => true, 'message' => 'Coupon is valid'];
    }

    /**
     * Calculate discount amount.
     */
    private function calculateDiscount($coupon, $orderAmount)
    {
        $discount = 0;

        if ($coupon->type === 'percentage') {
            $discount = ($orderAmount * $coupon->value) / 100;

            // Apply max discount limit
            if ($coupon->max_discount_amount && $discount > $coupon->max_discount_amount) {
                $discount = $coupon->max_discount_amount;
            }
        } else {
            $discount = min($coupon->value, $orderAmount);
        }

        return round($discount, 2);
    }

    /**
     * Check if user can use coupon.
     */
    private function canUseCoupon($coupon, $user)
    {
        if (!$coupon->is_active || ($coupon->expires_at && $coupon->expires_at <= now())) {
            return false;
        }

        if ($coupon->max_uses && $coupon->used_count >= $coupon->max_uses) {
            return false;
        }

        if ($coupon->per_user_limit) {
            $userUsage = CouponUsage::where('coupon_id', $coupon->id)
                ->where('user_id', $user->id)
                ->count();

            if ($userUsage >= $coupon->per_user_limit) {
                return false;
            }
        }

        if ($coupon->user_id && $coupon->user_id != $user->id) {
            return false;
        }

        return true;
    }

    /**
     * Generate a unique coupon code.
     */
    private function generateCouponCode($prefix = '', $suffix = '', $length = 8)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        $fullCode = $prefix . $code . $suffix;

        // Ensure uniqueness
        while (Coupon::where('code', $fullCode)->exists()) {
            $code = $this->generateRandomString($length);
            $fullCode = $prefix . $code . $suffix;
        }

        return $fullCode;
    }

    /**
     * Generate random string.
     */
    private function generateRandomString($length = 8)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
}
