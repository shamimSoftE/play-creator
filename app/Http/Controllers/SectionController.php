<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Session;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::latest()->get();
        return view('BackEnd.section.section-list', compact('sections'));
    }

    public function create()
    {
        return view('BackEnd.section.section-add');
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
        $section = Section::all()->count();

        if ($section <7)
        {
            Section::create($request->only('title'));

            return back()->with('sms','Section Stored');
        }
        else
        {
            Session::flash('error', 'You can not create section more then 7');
            return back();
        }

    }

    public function update(Section $section,Request $request)
    {

        $section->update($request->only('title'));

        return back()->with('sms','Section updated');
    }

    public function active(Request $request)
    {
        $section = Section::find($request->id);
        $section->status = 1;
        $section->save();
        return back()->with('sms','Section available in public');
    }
    public function hide(Request $request)
    {
        $section = Section::find($request->id);
        $section->status = 0;
        $section->save();
        return back()->with('sms','Section in private mode');
    }


    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return back()->with('sms','Section destroyed');
    }
}
