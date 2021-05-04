<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index()
    {
        $coins = Coin::latest()->get();

        return view('BackEnd.coin.coin_list',compact('coins'));
    }

    public function create()
    {
        return view('BackEnd.coin.coin_add');
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
        Coin::create($request->all());
        return back()->with('sms','Coin Stored');
    }


    public function update(Coin $coin,Request $request)
    {
        $coin->update($request->all());
        return back()->with('sms','Coin updated');
    }

    public function active($id)
    {
        $coin = Coin::find($id);
        $coin->status = 1;
        $coin->save();
        return back()->with('sms','Coin available in public');
    }
    public function hide($id)
    {
        $coin = Coin::find($id);
        $coin->status = 0;
        $coin->save();
        return back()->with('sms','Coin in private mode');
    }


    public function destroy($id)
    {
        $coin = Coin::find($id);
        $coin->delete();
        return back()->with('sms','Coin destroyed');
    }
}
