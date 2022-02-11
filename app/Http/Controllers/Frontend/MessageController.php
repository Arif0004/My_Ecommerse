<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    function index()
    {
        // return  auth('customer')->id();
        $navItem = 'message';
        $message = auth('customer')->user()->load('message');
        return view('Frontend.message.index', compact('navItem', 'message'));
    }

    function store(Request $request)
    {
        $message = Message::create([
            'customer_id' => auth('customer')->id(),
            'message' => $request->message
        ]);

        return back();
    }

    public function storeReply(Request $request, Message $message)
    {
        $reply = $message->replies()->create([
            'mode' => 'customer',
            'reply' => $request->reply
        ]);
        return back();
    }
}
