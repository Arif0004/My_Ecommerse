<?php

namespace App\Http\Controllers\Admin;

use App\Actions\File;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    function index()
    {
        return view('Backend.Category.index', ['navItem' => 'category']);
    }

    function fetchCategory()
    {
        return Category::latest()->get();
    }

    public function store(CategoryRequest $request)
    {
        info($request->all());
        $category =  Category::create([
            'name' => $request->name,
            'slug' => $request->name,
            'image' => File::upload($request->file('image'), 'category')
        ]);
        if ($category) {
            return true;
        }
    }

    public function destroy(Category $category)
    {
        $img = $category->image;
        $category->delete();
        File::deleteFile($img);
        return true;
    }

    public function show(Category $category)
    {
        return $category;
    }
    public function update(CategoryRequest $request, Category $category)
    {
        info($request->all());
        if ($request->has('file')) {
            dd($request->image);
            $olgImage = $category->image;
            info($request->file('image'));
            $category =   $category->update([
                'name' => $request->name,
                'slug' => $request->name,
                'image' => File::upload($request->file('image'), 'category')
            ]);
            File::deleteFile($olgImage);
        } else {
            $category =   $category->update([
                'name' => $request->name,
                'slug' => $request->name
            ]);
        }

        if ($category) {
            return true;
        } else {
            return false;
        }
    }
}
