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
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5> --}}
{{--
            <x-frontend.sorting-price :prices="$prices"/> --}}
                <!-- Price End -->

                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        @foreach ($colors as $color)
                            <div class="d-flex align-items-center justify-content-between">
                                <input type="checkbox" class=""  id="" value="{{ $color->name }}">
                                <label class="" for="">{{ $color->name }}</label>
                                <span class="badge border font-weight-normal">{{ $color->products->count() }}</span>
                            </div>
                            <hr>
                        @endforeach

                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        @foreach ($sizes as $size)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input"  id="size-all">
                            <label class="custom-control-label" for="price-all">{{ $size->name }}</label>
                            <span class="badge border font-weight-normal">{{ $size->products->count() }}</span>
                        </div>
                    @endforeach
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                @if (count($products) != 0)
                <div class="row pb-3">
                    <x-frontend.sorting/>
                    @foreach ($products as $product)
                        <x-product :product="$product"/>
                    @endforeach
                </div>
                <div  style="width: 10%;margin:0 auto">

                    {{ $products->links('pagination::custom') }}

                    @else
                    <h4 class="text-center text-danger mt-5">Product Not found!!</h4>
                @endif

                  </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


@stop

@push('script')

<script>
    let inputs = document.querySelectorAll('input[type="checkbox"]');
    inputs.forEach(input => {
        input.addEventListener('change',function(){
            console.log(this.value)
        })
    });
</script>
@endpush
