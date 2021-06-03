<?php

namespace App\Http\Controllers;

use App\Models\BuyCoin;
use App\Models\Order;
use App\Models\Category;
use App\Models\Coin;
use App\Models\Post;
use App\Models\Section;
use App\Models\Seller;
use Illuminate\Http\Request;

class FrontEnd extends Controller
{
    public function home()
    {
        return view('FrontEnd.home.home');
    }

    public function search()
    {
        $searchItem = \request()->query('query');
//        $searchCate = Category::where('name', 'LIKE', "%{$searchItem}%")->get();
        $searchCate = Post::where('category_id', 'LIKE', "%{$searchItem}%")->get();
        /*dd($searchCate);*/
        return view('FrontEnd.pages.cate_wise_pro',compact('searchCate'));
    }

    public function catePro($id)
    {
        $category = Category::find($id);

        $product = Post::where('category_id', $id)->orderBy('id','desc')->get();

        return view('FrontEnd.pages.cate_wise_pro',compact('product'));
    }


    public function coinList()
    {
        $coins = Coin::where('status',1)->get();
        return view('FrontEnd.pages.coin_page',compact('coins'));
    }

    public function purchasedProduct()
    {
        $user = auth()->user()->id;
        $purchasedPro = Order::where('user_id',$user)->latest()->get();
        return view('FrontEnd.pages.user_purchased_product_list',compact('purchasedPro'));
    }

    public function OrderManage()
    {
        $seller = Seller::where('user_id',auth()->user()->id)->first();

        $productOrder = Order::where('seller_id',$seller->id)->latest()->get();

        return view('FrontEnd.pages.seller_product_order_list',compact('productOrder'));
    }

    public function OrderComplete($id)
    {
        $order = Order::find($id);
        $order->status = 'completed';
        $order->save();
        return back()->with('sms', 'Order Completed');
    }


    public function purchasedCoin()
    {
        return view('FrontEnd.pages.user_purchased_coin_list');
    }

    public function dashboard() // user dashboard
    {
        $user = auth()->user()->id;
        $products = Post::where('user_id',$user)->latest()->get();
        $categories = Category::where('status',1)->get();
        $section = Section::where('status',1)->get();

        return view('FrontEnd.pages.user-dashboard',compact('products','categories', 'section'));
    }



}
