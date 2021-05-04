<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('BackEnd.category.category-list',compact('categories'));
    }

    public function create()
    {
        return view('BackEnd.category.category-add');
    }

    public function show()
    {
        //
    }

    protected function Img($request)
    {
        if($request->hasFile('image')){

            $img_tmp = $request->file('image');

            if ($img_tmp->isValid()){
                $img_exten = $img_tmp->getClientOriginalExtension();
                $img_name = $img_tmp->getClientOriginalName().'.'.$img_exten;
                $img_path = public_path('Back/images/category');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }

    public function store(Request $request)
    {
        $image_name = $this->Img($request);
        Category::create([
            'name' => $request->name,
            'image' => $image_name,
        ]);
        return back()->with('sms','Category Stored');
    }


    public function update(Category $category,Request $request)
    {

        $category->id;

        $img_tmp = $request->file('image');

        if ($img_tmp) /* you can update with image */
        {
            $img_exten = $img_tmp->getClientOriginalExtension();
            $img_name = $img_tmp->getClientOriginalName().'.'.$img_exten;
            $img_path = public_path('Back/images/category');
            $img_tmp->move($img_path,$img_name);

            $old_img = $category->image;

            if(file_exists($old_img)){
                unlink($old_img);
            }
            $category->name = $request->name;
            $category->image = $img_name;
        }else{
            $category->name = $request->name;
        }

        $category->save();
        return back()->with('sms','Category updated');
    }

    public function active($id)
    {
        $category = Category::find($id);
        $category->status = 1;
        $category->save();
        return back()->with('sms','Category available in public');
    }
    public function hide($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        return back()->with('sms','Category in private mode');
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back()->with('sms','Category destroyed');
    }
}
