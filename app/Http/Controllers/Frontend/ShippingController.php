<?php

namespace App\Http\Controllers\Frontend;

use App\Actions\File;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Mail\CustomerOrderMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ShippingRequest;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ShippingController extends Controller
{
    protected $order;
    protected $product;
    protected $quantity;
    public function shipping()
    {
        return view('Frontend.cart.shipping');
    }

    public function storeShippingAndOrder(ShippingRequest $request)
    {
        if ($request->payment_method === 'bksh') {
            if (!$request->trans_id) {
                session()->flash('warning', 'Enter Bksh Transition ID');
                return back();
            }
        }

        DB::transaction(function () use ($request) {

            # Store Shipping Address
            $shipping = Shipping::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'region' => $request->input('region'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'remark' => $request->input('remark'),
            ]);

            # Store Payment

            $payment = Payment::create([
                'method' => $request->payment_method,
                'total_amnt' => totalAmount(),
                'amount' => totalAmount(),
                'trans_id' => $request->trans_id ? $request->trans_id : null,
                'coupon' => \couponName(),
                'discount' => couponDiscount()
            ]);

            $this->order = Order::create([
                'unique_id' => generateUniqueId(),
                'customer_id' => auth('customer')->id(),
                'payment_id' => $payment->id,
                'shipping_id' => $shipping->id,
                'total' => totalAmount()
            ]);

            foreach (Cart::content() as $cart) {
                OrderDetail::create([
                    'order_id' => $this->order->id,
                    'product_id' => $cart->id,
                    'price' =>  $cart->price,
                    'quantity' =>  $cart->qty
                ]);

                Product::find($cart->id)->decrement('quantity', $cart->qty);
            }
            Cart::destroy();
            session()->forget('coupon');
        });
        if ($this->order) {


            Mail::to(auth('customer')->user()->email)->send(new CustomerOrderMail($this->order));;

            session()->flash('success', 'Accept Your Order');
            return redirect()->route('dashboard');
        }
    }
}
