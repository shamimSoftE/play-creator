<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\BuyCoin;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function checkout($id)
    {
        $coin = Coin::find($id);

        $buy = new BuyCoin();
        $buy->user_id = auth()->user()->id;
        $buy->coin_id = $coin->id;
        $buy->save();

        /*============ stripe secrete key ====================*/
        \Stripe\Stripe::setApiKey('sk_test_51ImrtVLRsujEO00Rv31RJLHKviBHFMfrFA0nKqWugSEfICVbzX5jbhJMnV0MDVWmVg0PUOmNboVyJ2BcHYS7o1Ql00fJeIhsBj');

        $amount = $coin->coin_price;
        $amount *= 100;
        $amount = (int) $amount;

        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => 'Stripe Test Payment',
            'amount' => $amount,
            'currency' => 'USD',
            'payment_method_types' => ['card'],
        ]);
        $intent = $payment_intent->client_secret;

        $user = Auth::user();

        $newBalance = $user->balance+$amount;

       DB::table('users')->where('id',Auth::id())->update([
            'balance' =>  $newBalance,
        ]);

        return view('FrontEnd.pages.checkout',compact('coin','intent'));
    }

    public function complete()
    {

        return redirect()->route('guest_home')->with('success','Thanks for your purchase');
    }

}
