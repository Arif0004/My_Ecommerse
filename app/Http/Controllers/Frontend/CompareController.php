<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Compare;

class CompareController extends Controller
{
    public function index()
    {
        $compares = Compare::with('product')->MyProducts()->latest()->paginate(5);
        $navItem = 'compare';
        return view('Frontend.dash.compare', compact('compares', 'navItem'));
    }

    public function store(Request $request)
    {
        if ($this->checkProductExist($request->product_id)) {

            Compare::create([
                'product_id' => $request->product_id,
                'customer_id' => auth('customer')->id()
            ]);
            session()->flash('success', 'Product added in Compare!');
            return back();
        } else {
            session()->flash('warning', 'This Product already added!');
            return back();
        }
    }

    protected function checkProductExist($id): bool
    {
        $wishlist = Compare::whereProductId($id)->whereCustomerId(auth('customer')->id())->first();
        // info($wishlist);
        if ($wishlist) {
            return false;
        }
        return true;
    }

    public function destroy(Compare $compare)
    {
        $compare->delete();
        session()->flash('success', 'Remove From Compare!');
        return back();
    }
}
