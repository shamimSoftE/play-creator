<?php

namespace App\Http\Controllers;

use App\Models\BuyCoin;
use App\Models\Coin;
use Illuminate\Http\Request;

class FrontEnd extends Controller
{
    public function home()
    {
        return view('FrontEnd.home.home');
    }

    public function coinList()
    {
        $coins = Coin::where('status',1)->get();
        return view('FrontEnd.pages.coin_page',compact('coins'));
    }


    public function dashboard() // user dashboard
    {
        $buyCoin = BuyCoin::latest()->get();


        return view('FrontEnd.include.user-dashboard',compact('buyCoin'));
    }



}
