@extends('layouts.backend_master')
@section('title', 'Product | ' . $product->name)
@section('master_content')
<div class="conatiner pt-4">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-success">Back</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
                    <td>{{ $product->name }}</td>
                    <th>Is Featured</th>
                    <td>{{ $product->info->is_featured === 1 ? 'Featured' : 'Not Featured'  }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $product->category->name }}</td>
                    <th>Sub Category</th>
                    <td>{{ $product->sub_category->name ?? 'NULL'}}</td>
                </tr>
                <tr>
                    <th>Color</th>
                    <td>{{ $product->color->name }}</td>
                    <th>Size</th>
                    <td>{{ $product->size->name }}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>$ {{ $product->info->price }}</td>
                    <th>Sell Price</th>
                    <td>$ {{ $product->info->sell_price }}</td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>{{ $product->quantity }}</td>
                    <th>View</th>
                    <td>{{  $product->info->view  }}</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <span class="text-success">Short Description : </span>
                    <p>{!! $product->short_des !!}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <span class="text-success">Long Description : </span>
                    <p>{!! $product->long_des !!}</p>
                    </td>
                </tr>
                <tr>
                    <td>Image</td>
                    <th colspan="3"><img src="{{ asset($product->info->image) }}" width="250px" alt=""></th>
                </tr>
                <tr>
                    <td>Slider Images</td>
                    <th colspan="3">
                        @foreach ($product->sliders as $img)
                        <img src="{{ asset($img->image) }}" width="250px" alt="" class="mb-2">
                        @endforeach
                    </th>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection

