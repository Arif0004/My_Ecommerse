<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    function index()
    {

        return view(
            'Backend.message.index',
            [
                'navItem' => 'message',
                'messages' => Message::with('customer')->latest()->get()
            ]
        );
    }


    function singleCustomerMessages(Message $message)
    {
        return view(
            'Backend.message.single',
            [
                'navItem' => 'message',
                'message' => $message,
                'messages' => Message::with('customer')->latest()->get()
            ]
        );
    }
    public function storeReply(Request $request, Message $message)
    {
        $reply = $message->replies()->create([
            'mode' => 'admin',
            'reply' => $request->reply
        ]);
        return back();
    }
}
