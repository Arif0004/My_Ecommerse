<?php

namespace App\Http\Controllers\Admin;

use App\Actions\File;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;

class SliderController extends Controller
{
    function index()
    {
        return view('Backend.Slider.index', ['navItem' => 'slider']);
    }

    function fetchSlider()
    {
        return Slider::latest()->get();
    }

    public function store(SliderRequest $request)
    {
        info($request->all());
        $Slider =  Slider::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => File::upload($request->file('image'), 'Slider')
        ]);
        if ($Slider) {
            return true;
        }
    }

    public function destroy(Slider $slider)
    {
        $img = $slider->image;
        $slider->delete();
        File::deleteFile($img);
        return true;
    }

    public function show(Slider $slider)
    {
        return $slider;
    }
    public function update(SliderRequest $request, Slider $slider)
    {
        info($request->file('image'));
        if ($request->has('file')) {
            dd($request->image);
            $olgImage = $slider->image;
            info($request->file('image'));
            $Slider =   $slider->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => File::upload($request->file('image'), 'Slider')
            ]);
            info('ok');
            File::deleteFile($olgImage);
        } else {
            $Slider =   $slider->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        if ($Slider) {
            return true;
        } else {
            return false;
        }
    }

    public function inActiveSlider(Slider $slider)
    {
        $slider->update([
            'status' => false
        ]);
    }
    public function activeSlider(Slider $slider)
    {
        $slider->update([
            'status' => true
        ]);
    }
}
