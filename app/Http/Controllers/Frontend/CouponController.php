<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function checkCouponIsValid(Request $request)
    {
        $request->validate([
            'name' => ['required', 'exists:coupons,name']
        ], [
            'name.required' => 'Field Must not be Empty!',
            'name.exists' => ' Invalid Coupon!',
        ]);

        $coupon = Coupon::where('name', $request->name)->isActive()->first();

        if (!$coupon) {
            session()->flash('warning', "This coupon is't valid!");
            return back();
        }
        if ($coupon->expired_date < now()->format('Y-m-d')) {
            session()->flash('error', 'This Coupon is Already Expired!');
            return back();
        }

        session()->put('coupon', [
            'name' => $coupon->name,
            'discount' => $coupon->discount
        ]);

        session()->flash('success', 'Successfully Coupon Added!');
        return back();
    }


    public function removeCoupon()
    {
        session()->forget('coupon');
        session()->flash('success', 'Coupon has Removed!');
        return back();
    }
}
