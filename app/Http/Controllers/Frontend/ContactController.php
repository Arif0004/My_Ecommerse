<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    function index()
    {
        return view('Frontend.contact');
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'subject' => ['required'],
            'text' => ['required'],
        ]);

        Contact::create($request->all());
        session()->flash('success', 'Thanks for Contact with us!');
        return back();
    }
}
