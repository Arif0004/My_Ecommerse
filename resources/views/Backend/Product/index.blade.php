
@extends('layouts.backend_master')
@section('title', 'Product')
@push('css')
<x-utility.data-table-css/>
@endpush
@section('master_content')
<div class="card">
    <div class="card-header ">
        <div class="d-flex justify-content-between">
        <h4 class="card-title">Manage Products</h4>
        <a href="{{ route('admin.product.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New Product</a>
        </div>

    </div>
    <div class="card-body">
        <table class="table table-bordered" id="ProductTable">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>View</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->info->view }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td> {{ $product->info->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>

                            @if ($product->info->is_active === 0)
                            <form action="{{ route('admin.product.active',$product->slug) }}" class="d-inline" method="POST">
                                @csrf
                                @method('PUT')
                                <button id="status" class="btn btn-sm btn-success"><i class="fa fa-arrow-up"></i></button>
                            </form>
                            @else
                            <form action="{{ route('admin.product.inactive',$product->slug) }}" class="d-inline" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-sm btn-warning"><i class="fa fa-arrow-down"></i></button>
                            </form>
                            @endif


                            <a href="{{ route('admin.product.show',$product->slug) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.product.edit', $product->slug) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>

                           <form action="{{ route('admin.product.destroy', $product->slug) }}" class="d-inline" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick=" return confirm('Are you Sure Delete This Data?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                           </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('script')
<x-utility.data-table-js/>
<script>
   $('#ProductTable').DataTable();

</script>
@endpush
