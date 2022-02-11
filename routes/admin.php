<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    SizeController,
    ColorController,
    SliderController,
    ProductController,
    WebsiteController,
    CategoryController,
    CouponController,
    CustomerController,
    DashboardController,
    SubCategoryController,
    MessageController,
    OrderController,
    SMSController
};

use Vonage\SMS\Client;
use App\Mail\CustomerBirthdayWishMail;
use App\Mail\CustomerOrderMail;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;

// Route::get('test', fn () => view('Backend.Category.test'));

Route::prefix('admin')->as('admin.')->middleware(['auth:admin'])->group(function () {

    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('category', CategoryController::class)->except(['create', 'edit']);
    Route::get('fetch-category', [CategoryController::class, 'fetchCategory'])->name('fetch-category');

    Route::resource('sub-category', SubCategoryController::class)->except(['create', 'edit']);
    Route::get('fetch-sub-category', [SubCategoryController::class, 'fetchSubCategory'])->name('fetch-sub-category');

    Route::resource('color', ColorController::class)->except(['create', 'edit']);
    Route::get('fetch-color', [ColorController::class, 'fetchColor'])->name('fetch-color');

    Route::resource('size', SizeController::class)->except(['create', 'edit']);
    Route::get('fetch-size', [SizeController::class, 'fetchSize'])->name('fetch-size');

    Route::resource('product', ProductController::class);
    Route::get('get-sub-category-by-category/{id}', [ProductController::class, 'getSubCategoryByCategory'])->name('get-sub-cat-by-cat');
    Route::put('product-inactive/{slug}', [ProductController::class, 'productInActive'])->name('product.inactive');
    Route::put('product-active/{slug}', [ProductController::class, 'productActive'])->name('product.active');



    Route::resource('slider', SliderController::class)->except(['create', 'edit']);
    Route::get('fetch-slider', [SliderController::class, 'fetchSlider'])->name('fetch-slider');
    Route::put('slider-inactive/{slider}', [SliderController::class, 'inActiveSlider'])->name('slider-inactive');
    Route::put('slider-active/{slider}', [SliderController::class, 'activeSlider'])->name('slider-active');

    Route::resource('website', WebsiteController::class)->except(['create', 'store', 'destroy', 'show']);

    Route::resource('coupon', CouponController::class)->except(['create', 'edit']);
    Route::get('fetch-coupon', [CouponController::class, 'fetchCoupon'])->name('fetch-coupon');


    # Order
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::get('order-details/{id}', [OrderController::class, 'orderDetails'])->name('order_details');
    Route::put('orders_on_going/{id}', [OrderController::class, 'makeOrderOnGoing'])->name('orders_on_going');
    Route::put('orders_received/{id}', [OrderController::class, 'makeOrderReceived'])->name('orders_received');

    Route::get('order_pdf/{id}', [OrderController::class, 'orderDetailsPdf'])->name('order_details_pdf');

    Route::get('orders/pending', [OrderController::class, 'pendingOrder'])->name('orders.pending');
    Route::get('orders/ongoing', [OrderController::class, 'onGoingOrder'])->name('orders.onGoing');
    Route::get('orders/received', [OrderController::class, 'receivedOrder'])->name('orders.received');

    # Message
    Route::get('message', [MessageController::class, 'index'])->name('message.index');
    Route::get('message/{message}', [MessageController::class, 'singleCustomerMessages'])->name('message');
    Route::post('reply/{message}', [MessageController::class, 'storeReply'])->name('reply');

    #Customer
    Route::get('customer/{customer}', [CustomerController::class, 'singleCustomer'])->name('customer');
});



// Route::get('pdf', function () {
//     $pdf = PDF::loadView('pdf.order_details');
//     return $pdf->stream('document.pdf');
// });

Route::get('test', function () {

    // $customers =  Customer::whereMonth('date_of_birth', today()->format('m'))
    //     ->whereDay('date_of_birth', today()->format('d'))
    //     ->get(['name', 'email', 'id']);

    // foreach ($customers as $customer) {
    //     Mail::to($customer->email)->send(new CustomerBirthdayWishMail($customer));
    // }
    // return 1;
});

// Route::get('sms', [SMSController::class, 'index']);
