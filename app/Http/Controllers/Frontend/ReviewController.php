<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        Review::create([
            'product_id' => $request->product_id,
            'customer_id' => auth('customer')->id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        session()->flash('success', 'Review Added Successfully');
        return back();
    }
}
