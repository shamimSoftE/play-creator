<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Section;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $categories = Category::where('status',1)->get();
        $section = Section::where('status',1)->get();

        return view('FrontEnd.product.post_list',compact('posts', 'section', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('status',1)->get();
        $section = Section::where('status',1)->get();

        return view('FrontEnd.product.user_post_add',compact('section', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'point' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
        ]);
        $user_id = auth()->user()->id;

        $seller = Seller::where('user_id', $user_id)->first();

        Post::create([
            'title' => $request->title,
            'point' => $request->point,
            'quantity' => $request->quantity,
            'section_id' => $request->section_id,
            'category_id' => $request->category_id,
            'seller_id' => $seller->id,
            'user_id' => $user_id,
        ]);

        return back()->with('sms', 'Post Created');
    }

    public function update(Request $request,$id)
    {
        $post = Post::find($id);

        /*dd($product);*/
        $post->update([
            'title' => $request->title,
            'point' => $request->point,
            'quantity' => $request->quantity,
            'section_id' => $request->section_id,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);
        return back()->with('sms', 'Post Updated');
    }

    public function active($id)
    {
        $product = Post::find($id);

        $product->status = 1;
        $product->save();
        return back();
    }

    public function hide($id)
    {
        $product = Post::find($id);

        $product->status = 0;
        $product->save();
        return back();
    }

    public function destroy($id)
    {
        $product = Post::find($id);

        $product->delete();
        return back()->with('sms', 'Product Deleted');
    }
}
