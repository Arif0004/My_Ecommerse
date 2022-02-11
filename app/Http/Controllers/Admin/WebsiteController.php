<?php

namespace App\Http\Controllers\Admin;

use App\Actions\File;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function index()
    {
        $website = Website::first();
        return view('Backend.website.index', ['navItem' => 'website'], compact('website'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        if ($request->file('logo')) {
            $oldImagePath = $website->logo;
            $website->update([
                'logo' => File::upload($request->file('logo'), 'website')
            ]);
            File::deleteFile($oldImagePath);
        }
        $website->update([
            // 'title' => $request->title,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'fb' => $request->fb,
            'tw' => $request->tw,
            'ins' => $request->ins,
            'link' => $request->link,
            'footer_1' => $request->footer_1,
            'footer_2' => $request->footer_2
        ]);
        session()->flash('success', 'Data Update Successfully!!');
        return redirect()->route('admin.website.index');
    }
}
