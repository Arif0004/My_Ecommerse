<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductInfo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['navItem'] = 'dashboard';
        $data['products'] = Product::withoutGlobalScope('isActive')->count();
        $data['product_price'] = ProductInfo::sum('price');
        $data['coupons'] = Coupon::count();
        $data['orders'] = Order::pending()->count();
        $data['order_received'] = Order::received()->count();
        return view('Backend.dashboard', $data);
    }
}
