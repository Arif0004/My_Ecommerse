<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    function index()
    {
        return view('Backend.Coupon.index', ['navItem' => 'coupon']);
    }

    function fetchCoupon()
    {
        return Coupon::latest()->get();
    }

    public function store(CouponRequest $request)
    {
        Coupon::create($request->only(['name', 'expired_date', 'discount']));
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
    }

    public function show(Coupon $Coupon)
    {
        return $Coupon;
    }
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->only(['name', 'expired_date', 'discount']));
    }
}
