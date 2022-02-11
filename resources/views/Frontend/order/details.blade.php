@extends('layouts.frontend_master')
@section('title', 'Order Details')

@section('frontend_master_content')
<div class="d-flex justify-content-md-between">
    <h4>Dashboard</h4>
    <a href="{{ route('orders') }}" class="btn btn-sm btn-info rounded">Back</a>
</div>
<hr>
<div class=" overflow-auto">
    <table class="table table-bordered table-hover" >
        <tr>
            <th>Order ID</th>
            <td>{{ $order->unique_id }}</td>
            <th>Date</th>
            <td>{{ $order->created_at->diffForHumans() }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ Str::ucfirst($order->status) }}</td>
            <th>Payment Method</th>
            <td>{{ $order->payment->method }}</td>
        </tr>
        <tr>
           @if ($order->payment->method === 'bksh')
           <th>Transction ID</th>
           <td>{{ $order->payment->trans_id }}</td>
           @endif
           @if ($order->payment->coupon)
           <th>Coupon</th>
           <td>{{ $order->payment->coupon }}</td>
           <th>Discount</th>
           <td>{{ $order->payment->discount }}%</td>
           @endif
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>${{ $order->payment->total_amnt }}</td>
            <th>Amount</th>
            <td>${{ $order->payment->amount }}</td>
        </tr>
        <tr>
            <th colspan="4">
                <h6 class="text-center">Shipping Address</h6>
            </th>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $order->shipping->name }}</td>
            <th>Email</th>
            <td>{{ $order->shipping->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $order->shipping->phone }}</td>
            <th>Region</th>
            <td>{{ $order->shipping->region }}</td>
        </tr>
        <tr>
            <th>City</th>
            <td>{{ $order->shipping->city }}</td>
            <th>Address</th>
            <td>{{ $order->shipping->address }}</td>
        </tr>
        <tr>
            <th>Remark</th>
            <td colspan="3">{{ $order->shipping->remark }}</td>
        </tr>
        <tr>
            <th colspan="4">
                <h6 class="text-center">Products</h6>
            </th>
            <tr>
                <th>SL</th>
                <th width="10%">Name</th>
                <th>Price</th>
                <th style="width:5%!important">Quantity</th>
                <th>Total</th>
            </tr>
            @php
                $total = 0;
                $quantity = 0;
            @endphp
            @foreach ($order->products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product->name }}</td>
                <td>$ {{ $product->product->info->sell_price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>$ {{ $product->quantity * $product->product->info->sell_price  }}</td>
            </tr>
            @php
                $total  += $product->quantity * $product->product->info->sell_price;
                $quantity += $product->quantity;
                $discount = calculateDiscount($total,$order->payment->discount);
                $shipping = $quantity * 10;
            @endphp
            @endforeach
        </tr>
        <tr>
            <th colspan="3"></th>
            <th>Total</th>
            <td>$ {{ $total }}</td>
        </tr>
        <tr>
            <th colspan="3"></th>
            <th>Discount</th>
            <td>- $ {{$discount }}</th>
        </tr>
        <tr>
            <th colspan="3"></th>
            <th>Shipping</th>
            <td>$ {{$shipping }}</th>
        </tr>
        <tr>
            <th colspan="3"></th>
            <th>Grand Total</th>
            <td>$ {{ ($total - $discount) + $shipping}}</td>
        </tr>
    </table>
</div>
@stop
