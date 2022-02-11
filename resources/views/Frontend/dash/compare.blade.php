@extends('layouts.frontend_master')
@section('title','Compare')

@section('frontend_master_content')
<h4>My Compare Items</h4>
<table class="table table-bordered table-hover">
    <tr>
        <th>SL</th>
        <th>Image</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Date</th>
        <th class="text-center">Actions</th>
    </tr>
    @forelse ($compares as $compare)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>
                <img src="{{ asset($compare->product->info->image) }}" alt="" width="100px">
            </td>
            <td>
                <a class="text-success" href="{{ route('single-product',$compare->product->slug) }}">{{ $compare->product->name }}</a>
            </td>
            <td>
                <a class="text-success" href="{{ route('single-product',$compare->product->slug) }}">$ {{ $compare->product->info->sell_price }}</a>
            </td>
            <td>{{ $compare->created_at->diffForHumans() }}</td>
            <td class="text-center">
            <form action="{{ route('add-to-cart',$compare->product) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" value="1"  name="quantity">
                <button type="submit" class="btn btn-sm btn-success rounded" ><i class="fa fa-shopping-cart"></i></button>
            </form>

            <form action="{{ route('compare.destroy',$compare->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger rounded" ><i class="fa fa-trash"></i></button>
        </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center"><span class="text-danger">Empty!!</span></td>
        </tr>
        @endforelse
</table>
@stop
