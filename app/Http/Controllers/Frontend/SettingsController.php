<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $navItem = 'settings';
        return view('Frontend.settings.index', compact('navItem'));
    }
    public function password()
    {
        $navItem = 'settings';
        return view('Frontend.settings.password', compact('navItem'));
    }
    public function updateInformation(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['numeric', 'nullable'],
        ]);
        auth('customer')->user()->update($request->all());
        session()->flash('success', 'Profile Updated');
        return back();
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_pass' => ['required'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);
        //  return auth('customer')->user()->password;
        if (Hash::check($request->old_pass, auth('customer')->user()->password)) {
            auth('customer')->user()->update(['password' => bcrypt($request->password)]);
            session()->flash('success', "Password Updated Successfully!");
            auth('customer')->logout();
            return redirect()->route('login');
        } else {
            session()->flash('warning', "Old Password didn't match!!");
            return back();
        }
    }
}
