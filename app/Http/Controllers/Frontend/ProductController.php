<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function singleProduct(Product $product)
    {
        $product->load('reviews');
        $product->info->increment('view', 1);
        $product->save();
        $related_products = Product::Similar($product->category_id)->inRandomOrder()->take(4)->get();
        return view('singleProduct', compact('product', 'related_products'));
    }

    public function dynamicSearch($query)
    {
        return Product::where('name', 'like', "%$query%")->get(['name', 'slug']);
    }

    public function categoryWiseProducts(Category $slug)
    {
        $data = [];
        $data['products'] = $slug->products()->paginate(3);
        $data['colors'] = Color::with('products:color_id')->latest()->get(['name', 'slug', 'id']);
        $data['sizes'] = Size::with('products:size_id')->latest()->get(['name', 'slug', 'id']);
        return view('shop', $data);
    }

    public function subCategoryWiseProducts(SubCategory $slug)
    {
        $data = [];
        $data['products'] = $slug->products()->paginate(3);
        $data['colors'] = Color::with('products:color_id')->latest()->get(['name', 'slug', 'id']);
        $data['sizes'] = Size::with('products:size_id')->latest()->get(['name', 'slug', 'id']);
        return view('shop', $data);
    }
}
