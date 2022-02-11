<?php

namespace App\Http\Controllers\Admin;

use App\Actions\File;
use App\Models\Order;
use function Psy\info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('Backend.order.index', ['navItem' => 'order'], compact('orders'));
    }

    function makeOrderOnGoing(Order $id)
    {
        $id->status = 'ongoing';
        $id->save();
        session()->flash('success', 'Order Status Changed!!');
        return back();
    }

    function makeOrderReceived(Order $id)
    {
        $id->status = 'received';
        $id->save();
        session()->flash('success', 'Order Status Changed!!');
        return back();
    }


    public function orderDetails(Order $id)
    {
        $order = $id->load(['shipping', 'payment', 'products', 'customer']);

        return view('Backend.order.details', ['navItem' => 'order'], compact('order'));
    }

    public function orderDetailsPdf(Order $id)
    {
        $order = $id->load(['shipping', 'payment', 'products', 'customer']);
        $pdf = PDF::loadView('pdf.order_details', compact('order'));


        //    Storage::put('public/pdf/invoice.pdf', $pdf->output());

        return $pdf->download("{$order->unique_id}.pdf");
    }

    public function pendingOrder()
    {
        $orders = Order::pending()->get();
        return view('Backend.order.pending', ['navItem' => 'order'], compact('orders'));
    }
    public function onGoingOrder()
    {
        $orders = Order::onGoing()->get();
        return view('Backend.order.ongoing', ['navItem' => 'order'], compact('orders'));
    }
    public function receivedOrder()
    {
        $orders = Order::received()->get();
        return view('Backend.order.received', ['navItem' => 'order'], compact('orders'));
    }
}
