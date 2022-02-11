<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function index()
    {
        $wishlists = Wishlist::with('product')->MyProducts()->latest()->paginate(5);
        $navItem = 'wishlist';
        return view('Frontend.dash.wishlist', compact('wishlists', 'navItem'));
    }

    public function store(Request $request)
    {
        if ($this->checkProductExist($request->product_id)) {

            Wishlist::create([
                'product_id' => $request->product_id,
                'customer_id' => auth('customer')->id()
            ]);
            session()->flash('success', 'Product added in Wishlist!');
            return back();
        } else {
            session()->flash('warning', 'This Product already added!');
            return back();
        }
    }

    protected function checkProductExist($id): bool
    {
        $wishlist = Wishlist::whereProductId($id)->whereCustomerId(auth('customer')->id())->first();
        // info($wishlist);
        if ($wishlist) {
            return false;
        }
        return true;
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        session()->flash('success', 'Remove From Wishlist!');
        return back();
    }
}
