@extends('layouts.backend_master')
@section('title','Admin Dashboard')
@section('master_content')
<div class="row mt-2">
    <div class="col-lg-3 col-6 ">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $products }}</h3>

            <p>Total Product</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ route('admin.product.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6 ">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $coupons }}</h3>

            <p>Total Coupon</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ route('admin.coupon.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6 ">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $orders }}</h3>

            <p>New Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ route('admin.orders.pending') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6 ">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $order_received }}</h3>

            <p>Received Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ route('admin.orders.received') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6 mb-2">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{ $product_price }}</h3>

            <p>Product Price</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
</div>
@stop
