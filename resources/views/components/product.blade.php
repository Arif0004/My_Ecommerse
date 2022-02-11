<div class="col-lg-3 col-md-4 col-sm-6 pb-1">
    <div class="product-item bg-light mb-4">
        <div class="product-img position-relative overflow-hidden">
            <img class="img-fluid w-100" src="{{ asset($product->info->image) }}" alt="">
            <div class="product-action">
                <form action="{{ route('add-to-cart',$product) }}" method="POST">
                        @csrf
                        <input type="hidden" value="1"  name="quantity">
                    <button type="submit" class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></button>
                </form>
                <form action="{{ route('wishlist',$product) }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $product->id }}"  name="product_id">
                <button type="submit" class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></button>
            </form>
            <form action="{{ route('compare',$product) }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $product->id }}"  name="product_id">
            <button type="submit" class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></button>
        </form>
                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
            </div>
        </div>
        <div class="text-center py-4">
            <a class="h6 text-decoration-none text-truncate" href="{{ route('single-product',$product->slug) }}">{{ $product->name }}</a>
            <div class="d-flex align-items-center justify-content-center mt-2">
                <h5>${{ $product->info->sell_price }}</h5><h6 class="text-muted ml-2"><del>${{ $product->info->price }}</del></h6>
            </div>
            <div class="d-flex align-items-center justify-content-center mb-1">
                 @php
                $star = calculateProductStar($product->reviews);
            @endphp

            @if($star)
                @for ($i = 1 ; $i <= $star; $i++)
                <i class="fa fa-star text-warning"></i>
                @endfor
            @endif
                <small>({{ count($product->reviews) }})</small>
            </div>
        </div>
    </div>
</div>
