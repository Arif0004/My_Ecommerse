<?php

namespace App\Http\Middleware;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //  dd($request->url());
        if (Cart::count() === 0) {
            session()->flash('warning', 'Cart is Empty!!');
            return redirect()->route('shop');
        }
        return $next($request);
    }
}
