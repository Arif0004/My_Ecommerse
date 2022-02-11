<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        //  return Product::isActive()->get()->count();
        $data = [];
        $data['sliders'] = Slider::latest()->get();
        $data['categories'] = Category::with('products')->latest()->get();
        $data['latest_products'] = Product::withOnly('info')->latest()->take(8)->get();
        $data['featured_products'] = Product::withOnly('info')->isFeatured()->latest()->take(8)->get();
        $data['best_selling_products'] = Product::withOnly('info')->bestSelling()->latest()->take(8)->get();
        return view('home', $data);
    }
}
