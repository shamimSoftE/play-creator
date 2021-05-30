<?php

namespace App\Http\Controllers;

use App\Models\BankTransfer;
use App\Models\Coin;
use Auth;
use App\Models\BuyCoin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankTransferController extends Controller
{
    public function checkView($id)
    {
        $order = BankTransfer::find($id);
        return view('BackEnd.view',compact('order'));
    }
    public function destroy($id)
    {
        $order = BankTransfer::find($id);
        $order->delete();
        return back()->with('sms', 'Order deleted');
    }


    protected function Img($request)
    {
        if($request->hasFile('screenshot')){

            $img_tmp = $request->file('screenshot');

            if ($img_tmp->isValid()){
                $img_name = $img_tmp->getClientOriginalName();
                $img_path = public_path('Back/images/check');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }

    public function bank(Request $request)
    {

        $image = $this->Img($request);

        BankTransfer::create([
           'user_id' => auth()->user()->id,
           'screenshot' => $image,
           'amount' => $request->amount,
           'coin_id' => $request->coin_id,
        ]);

        return redirect()->route('guest_home')->with('success','Thanks for your purchase We will confirm you soon');
    }

    /*==================== for admin panel function =========================*/

    public function index()
    {
        $orders = BankTransfer::latest()->get();

        return view('BackEnd.order.order_with_bank_list',compact('orders'));
    }
    public function confirm($id)
    {
        $order = BankTransfer::find($id);

        $coin_buy = new BuyCoin();
        $coin_buy->user_id = $order->user_id;
        $coin_buy->coin_id = $order->coin_id;
        $coin_buy->save();

        $user = Auth::user();

        $newBalance = $user->balance+$order->coin->coin_amount;

        DB::table('users')->where('id',$order->user_id)->update([
            'balance' =>  $newBalance,
        ]);

        $order->status = 1;
        $order->save();
        return back()->with('sms', 'Order confirmed');
    }
}
