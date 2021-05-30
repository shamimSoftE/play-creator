<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Chatting;
use App\Models\Post;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class ChattingController extends Controller
{
    public function index()
    {
        //
    }

    public function chat($id)
    {
        $receiver_id = $id;
//       $product_id = $request->pro_id;

        $user = auth()->user()->id;
        $chats = Chat::where('receiver_id',$receiver_id)
            ->where('sender_id',$user)
            ->get();
        return view('FrontEnd.chat.chat_box',compact(
            'receiver_id',
//           'product_id',
            'chats'
        ));
    }

    public function store(Request $request)
    {
        $sender_id = auth()->user()->id;
        Chat::create([
            'sender_id' => $sender_id,
            'receiver_id' => $request->receiver_id,
//            'product_id' => $request->product_id,
            'message' => $request->message,
        ]);

        return back();
    }

    public function viewMessage($id)
    {
        $message = Chat::find($id);
        $message->status = '1';
        $message->save();   /*change status*/

        $auth_id = auth()->user()->id;
        $chats = Chat::where('receiver_id',$message->sender_id)
            ->where('sender_id',$auth_id)
            ->orWhere('receiver_id',$auth_id)
            ->where('sender_id',$message->sender_id)
            ->get();

        return view('FrontEnd.chat.chat_box', compact('message','chats'));

    }

    /* ================ admin message function =========== */

    public function readMessage($id)
    {
        $sms = Chat::find($id);
        $sms->status = '1';
        $sms->save();
//        dd($sms);
        $me = auth()->guard('admin')->user()->id;

        $chats = Chat::where('receiver_id',$me)
                        ->where('sender_id',$sms->sender_id)
                        ->orWhere('receiver_id',$sms->sender_id)
                        ->where('sender_id',$me)
                        ->get();
//        dd($chats);

        return view('BackEnd.chat.message_view', compact('chats', 'sms'));
    }

    public function replyMessage(Request $request)
    {
        $my_id = auth()->guard('admin')->user()->id;

//        dd($request->all());

        Chat::create([
            'sender_id' => $my_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return back();
    }


}
