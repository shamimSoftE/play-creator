<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Section;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $admin = auth()->guard('admin')->user()->id;

        $products = Post::where('admin_id', $admin)->latest()->get();
        $categories = Category::where('status',1)->get();
        $section = Section::where('status',1)->get();

        return view('BackEnd.product.product_list',compact('products', 'section', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('status',1)->get();
        $section = Section::where('status',1)->get();

        return view('BackEnd.product.product_add',compact('section', 'categories'));
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
        $admin = auth()->guard('admin')->user()->id;

        Post::create([
            'title' => $request->title,
            'quantity' => $request->quantity,
            'point' => $request->point,
            'section_id' => $request->section_id,
            'category_id' => $request->category_id,
            'admin_id' => $admin
        ]);

        return back()->with('sms', 'Post Created');
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->update([
            'title' => $request->title,
            'quantity' => $request->quantity,
            'point' => $request->point,
            'section_id' => $request->section_id,
            'category_id' => $request->category_id,
        ]);

        return back()->with('sms', 'Post Updated');
    }

    public function active(Request $request)
    {
        $post = Post::find($request->id);
        $post->status = 1;
        $post->save();
        return back()->with('sms','Post available in public');
    }
    public function hide(Request $request)
    {
        $post = Post::find($request->id);
        $post->status = 0;
        $post->save();
        return back()->with('sms','Post in private mode');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return back()->with('sms','Post Deleted');
    }

}
