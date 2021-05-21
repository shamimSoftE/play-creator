<?php

namespace App\Http\Controllers;

use App\Models\BuyCoin;
use Illuminate\Http\Request;

class BuyCoinController extends Controller
{
    public function index()
    {
        $soldBy = BuyCoin::latest()->get();

        return view('BackEnd.coin.soldBy_coin',compact('soldBy'));
    }

    public function trash($id)
    {
        $soldItem = BuyCoin::find($id);
        $soldItem->delete();

        return back()->with('sms', 'Data Deleted');

    }
}
