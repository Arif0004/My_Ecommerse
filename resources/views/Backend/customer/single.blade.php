
@extends('layouts.backend_master')
@section('title' )
{{ $customer->name }}
@endsection
@section('master_content')
<div class="card pt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover" >
            <tr>
                <th>Name</th>
                <td>{{ $customer->name }}</td>
                <th> Email</th>
                <td>{{ $customer->email }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $customer->phone }}</td>
                <th> Address</th>
                <td>{{ $customer->address }}</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{ $customer->date_of_birth }}</td>
                <th> City</th>
                <td>{{ $customer->city }}</td>
            </tr>
        </table>
        <h4 class="text-center mt-2 text-bold text-info">{{ $customer->name }}'s Order</h4>
        <table class="mt-2 table table-border table-striped">
            <tr>
                <th>SL</th>
                <th>Order ID</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <tbody>
                @forelse ($customer->orders as $order)
                <tr>
                    <td>{{ $loop->index + 1  }}</td>
                    <td>{{ $order->unique_id }}</td>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>{{ Str::ucfirst($order->status) }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.order_details',$order->unique_id) }}" class="btn btn-sm rounded btn-success"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Empty</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection

