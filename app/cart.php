<?php

use Gloudemans\Shoppingcart\Facades\Cart;

function couponName()
{
    if (session('coupon')) {
        return session('coupon')['name'];
    }
    return null;
}

function couponDiscount()
{
    if (session('coupon')) {
        return session('coupon')['discount'];
    }
    return null;
}

function shippingCost()
{
    return Cart::count() * 10;
}

function totalCartPrice()
{
    $sum = 0;
    foreach (Cart::content() as $cart) {
        $total = $cart->price * $cart->qty;
        $sum += $total;
    }

    return (float)$sum;
}

function totalDiscount()
{
    return totalCartPrice() * (couponDiscount() / 100);
}

function totalPriceWithShipping()
{
    return shippingCost() + totalCartPrice();
}

function totalPriceWithDiscount()
{
    return (totalCartPrice() - totalDiscount()) + shippingCost();
}


function totalAmount()
{
    if (session('coupon')) {
        return totalPriceWithDiscount();
    } else {
        return totalPriceWithShipping();
    }
}

function calculateDiscount($amount, $dis)
{
    return $amount * ($dis / 100);
}
