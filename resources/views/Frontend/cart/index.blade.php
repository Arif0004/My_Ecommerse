@extends('layouts.frontend_app')
@section('title','Shop')

@section('app_content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('shop') }}">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products {{ Cart::subtotal() }}</th>
                            <th>Price </th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                           // Cart::destroy();
                        @endphp
                        <form action="">
                            @foreach (Cart::content() as $item)
                                <tr>
                                    <td class="align-middle"><img src="{{ asset($item->options->image) }}" alt="" style="width: 50px;">
                                        <a href="{{ route('single-product',$item->options->slug) }}" style="color: #111;text-deoration:none">
                                        {{ $item->name }}</a>

                                        </td>
                                    <td class="align-middle">${{ $item->price }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('cart.update_single',$item->rowId) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" type="button">
                                                <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="number" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $item->qty }}" name="quantity">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">${{ $item->qty * $item->price }}</td>
                                    <td class="align-middle">
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                    </form>
                                        <form action="{{ route('cart.remove_single',$item->rowId) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                    </form>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                @if (!session('coupon'))
                <form class="mb-30" action="{{ route('coupon') }}" method="POST">
                    @csrf
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code" name="name" value="{{ old('name') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                @else
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="font-weight-medium text-success">Coupon Applied (<b><span>{{ couponName() }}</span></b>)</h6>
                            <h6 class="font-weight-medium">
                                <span>Discount : </span>
                                <span class="text-success">{{ couponDiscount() }}%</span>
                            </h6>
                        </div>
                        <form action="{{ route('coupon') }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-trash"></i>  Remove Coupon</button>
                        </form>
                    </div>
                </div>
                @endif
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>

                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>${{ totalCartPrice() }}</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Shipping Cost</h6>
                            <h6>$ {{ shippingCost() }}</h6>
                        </div>
                        @if (session('coupon'))
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Discount</h6>
                            <h6> - ${{ totalDiscount()}}</h6>
                        </div>
                        @endif

                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            @if (session('coupon'))
                            {{ totalPriceWithDiscount() }}
                            @else
                            <h5>${{ totalPriceWithShipping()}}</h5>
                            @endif
                        </div>
                        <a href="{{ route('shipping') }}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->





@stop
