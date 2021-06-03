<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{

    public function withdraw ($id)
    {
        $user = User::find($id);

        return view('FrontEnd.pages.withdraw_form',compact('user'));
    }

    public function confirm(Request $request)
    {
        $user = User::find($request->user_id);

       $newBalance = auth()->user()->balance - $user->balance;
       Withdraw::create([
           'user_id' => $user->id,
           'coin_amount' => $user->balance,
           'service_charge' => $request->service_charge
       ]);

       $newBalance = auth()->user()->balance - $user->balance;

       DB::table('users')->where('id',$user->id)->update([
           'balance' =>  $newBalance,
       ]);

        return redirect()->route('user_profile')->with('sms', 'Your request has been proceed');
    }

    public function index()
    {
       $withdraw = Withdraw::latest()->get();
       return view('FrontEnd.pages.withdraw_list',compact('withdraw'));
    }

    public function pending()
    {
        $withdraw = Withdraw::latest()->get();
        return view('BackEnd.withdraw.withdraw_pending_list',compact('withdraw'));
    }

    public function complete($id)
    {
        $draw = Withdraw::find($id);
        $draw->status = 1;
        $draw->save();
        return back()->with('sms', 'Withdraw Completed');
    }

}
