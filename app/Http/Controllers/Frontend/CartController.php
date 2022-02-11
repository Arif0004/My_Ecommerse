<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    function viewCart()
    {
        if (Cart::count() === 0) {
            session()->flash('warning', 'Cart is Empty!');
            return redirect()->route('shop');
        }
        return view('Frontend.cart.index');
    }

    function addToCart(Request $request, Product $product)
    {
        Cart::add([
            'id' => $product->id,
            'qty' => $request->quantity,
            'price' => $product->info->sell_price,
            'name' => $product->name,
            'weight' => 0,
            'options' => [
                'image' => $product->info->image,
                'slug' => $product->slug,
            ]
        ]);
        session()->flash('success', 'Product added to  Cart!');
        return back();
    }

    public function removeSingleItem($id)
    {
        Cart::remove($id);
        session()->flash('success', 'Product Remove from Cart!');
        return back();
    }

    public function updateSingleItem(Request $request, $id)
    {
        Cart::update($id, $request->quantity);
        session()->flash('success', 'Cart Updated Successfully!');
        return back();
    }
}
