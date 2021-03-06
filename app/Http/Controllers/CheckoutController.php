<?php

namespace App\Http\Controllers;

use App\Models\BuyUc;
use App\Models\Coin;
use App\Models\BuyCoin;
use App\Models\Order;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
use Mail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function checkout($id)
    {
        $coin = Coin::find($id);

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


        return view('FrontEnd.pages.checkout',compact('coin','intent'));
    }

    public function complete(Request $request)
    {
        $coin = Coin::find($request->id);

        $buy = new BuyCoin();
        $buy->user_id = auth()->user()->id;
        $buy->coin_id = $coin->id;
        $buy->save();

        $user = Auth::user();

        $newBalance = $user->balance+$coin->coin_amount;

        DB::table('users')->where('id',Auth::id())->update([
            'balance' =>  $newBalance,
        ]);
        return redirect()->route('guest_home')->with('success','Thanks for your purchase');
    }

    /* ========================= uc method =================== */

    public function buyConfirm (Request $request)
    {

        $product = Post::find($request->id);

        $coins = $product->point;

        /*============== Add point to seller id ==========*/

        $seller_new_point = $product->user->balance + $coins;

        DB::table('users')->where('id',$product->user_id)->update([
            'balance' =>  $seller_new_point,
        ]);
        /*==============  Check customer(user) point  ==========*/

        $user = Auth::user();
        if ($user->balance < $coins )
        {
            return redirect()->route('coin_list')->with('error',' You need to buy coin first');
//            dd('coin kin hala');
        }else{
            if (!empty($product->user->email))
            {
                $userEmail = $product->user->email;
                $userName = $product->user->name;

                $data = [
                    'name' => $userName,
                    'point' => $product->point,
                    'category' => $product->category->name,
                    'email' => $userEmail,
                    'coin' => $coins,
                ];

                Mail::send('FrontEnd.pages.new_order_mail',compact('data'), function ($message) use($data) {
                    $message->to($data['email']);
                    $message->subject('order');
                });

            }else
            {
                $admin_email = $product->admin->email;
                $admin_name = $product->admin->name;

                $dataTwo = [
                    'name' => $admin_name,
                    'point' => $product->point,
                    'category' => $product->category->name,
                    'email' => $admin_email,
                    'coin' => $coins,
                ];

                Mail::send('FrontEnd.pages.new_order_mail_two',compact('dataTwo'), function ($message) use($dataTwo) {
                    $message->to($dataTwo['email']);
                    $message->subject('New order');
                });
            }

            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->post_id = $request->id;
            $order->seller_id = $request->seller_id;
            $order->game_id = $request->game_id;
            $order->save();

            $newBalance = $user->balance-$coins;

            DB::table('users')->where('id',Auth::id())->update([
                'balance' =>  $newBalance,
            ]);
        }

        return redirect()->route('guest_home')->with('success','Thanks for your order. We will contact you as soon as possible');
    }


}
