@extends('layouts.frontend_master')
@section('title','Order')

@section('frontend_master_content')
<h4>My Orders</h4>
<table class="table table-bordered table-hover mt-3">
    <tr>
        <th>SL</th>
        <th>Order ID</th>
        <th>Date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    @forelse ($orders as $order)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $order->unique_id }}</td>
            <td>{{ $order->created_at }}</td>
            <td><b>{{ ucfirst($order->status) }}</b></td>
            <td>
                <a href="{{ route('order_details',$order->unique_id) }}" class="btn btn-sm btn-success rounded"><i class="fa fa-eye"></i></a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">
                <span class="text-warning">You haven't Order anything...</span>
            </td>
        </tr>
    @endforelse
</table>
@stop
