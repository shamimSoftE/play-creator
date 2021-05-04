<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Section;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $categories = Category::where('status',1)->get();
        $section = Section::where('status',1)->get();

        return view('FrontEnd.post.post_list',compact('posts', 'section', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('status',1)->get();
        $section = Section::where('status',1)->get();

        return view('FrontEnd.post.post_add',compact('section', 'categories'));
    }

    public function store(Request $request)
    {

        Post::create([
            'title' => $request->title,
            'point' => $request->point,
            'price' => $request->price,
            'section_id' => $request->section_id,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        return back()->with('sms', 'Post Created');
    }

    public function update(Post $post,Request $request)
    {
        $post->update([
            'title' => $request->input('title', $post->title),
            'point' => $request->input('point', $post->point),
            'price' => $request->input('price', $post->price),
            'section_id' => $request->input('section_id', $post->section_id),
            'category_id' => $request->input('category_id', $post->category_id),
            'user_id' => auth()->user()->id,
        ]);
        return back()->with('sms', 'Post Updated');
    }
}
