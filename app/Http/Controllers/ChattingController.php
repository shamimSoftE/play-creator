<?php

namespace App\Http\Controllers;

use App\Models\Chatting;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class ChattingController extends Controller
{
   public function index()
   {
       //
   }

   public function chatting($id)
   {
       $seller = Seller::find($id);
       $user = auth()->user()->id;
       $chattings = Chatting::where('seller_id',$seller->id)
                                        /*->where('user_id','!=',$seller->id)*/
                                        ->where('user_id',$user)
                                        ->get();
       return view('FrontEnd.chat.chat_box',compact('chattings','seller'));
   }

   public function replay()
   {
       $user = auth()->user()->id;
       $chatReply = Chatting::where('seller_id',$user)->get();

//       return view('FrontEnd.user-dashboard',compact('chatReply'));
   }

   public function create()
   {
       $sellers = Seller::where('status',1)->get();

     /*  $chatting = Chatting::all();

       dd($chatting);*/

       return view('FrontEnd.chat.chat_list',compact('sellers'));
   }

   public function store(Request $request)
   {
       $sender = auth()->user()->id;
       Chatting::create([
          'user_id' => $sender,
          'seller_id' => $request->receiver_id,
           'message' => $request->message,
       ]);
//       dd($request->all());
       return back();
   }
}
