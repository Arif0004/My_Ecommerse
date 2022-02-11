<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $navItem = 'orders';
        $orders = Order::MyOrders()->latest()->get();
        return view('Frontend.order.index', compact('navItem', 'orders'));
    }

    public function getOrderDetails(Order $id)
    {
        $navItem = 'orders';
        $order = $id->load(['payment', 'products', 'shipping']);
        return view('Frontend.order.details', compact('navItem', 'order'));
    }
}
