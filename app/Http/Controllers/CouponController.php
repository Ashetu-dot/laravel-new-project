<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function customerCoupons()
    {
        return view('customer.coupons');
    }

    public function show($id)
    {
        return view('coupons.show');
    }

    public function redeem(Request $request, $id)
    {
        return response()->json(['success' => true]);
    }

    public function vendorCoupons($vendorId)
    {
        return response()->json([]);
    }

    public function apply(Request $request)
    {
        return response()->json(['success' => true]);
    }

    public function adminIndex()
    {
        return view('admin.coupons.index');
    }

    public function generate(Request $request)
    {
        return redirect()->back()->with('success', 'Coupon generated successfully.');
    }

    public function adminDelete($id)
    {
        return redirect()->back()->with('success', 'Coupon deleted successfully.');
    }
}