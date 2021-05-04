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
        $posts = Post::latest()->get();
        $categories = Category::where('status',1)->get();
        $section = Section::where('status',1)->get();

        return view('BackEnd.post.post_list',compact('posts', 'section', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('status',1)->get();
        $section = Section::where('status',1)->get();

        return view('BackEnd.post.post_add',compact('section', 'categories'));
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
        /*dd($request->all());*/

        Post::create($request->all());

        return back()->with('sms', 'Post Created');
    }

    public function update(Post $post,Request $request)
    {
        $post->update($request->all());
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
