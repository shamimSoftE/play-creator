<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Auth;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function register()
    {
        return view('BackEnd.admin-auth.register');
    }

    public function store(Request $request)
    {

//        dd($request->all());

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();
        return redirect()->route('admin_dashboard');
    }

    public function login()
    {
        return view('BackEnd.admin-auth.login');
    }

    public function check(Request $request)
    {
        $verify = $request->all();

        if (Auth::guard('admin')->attempt(['email' => $verify['email'], 'password' => $verify['password']]))
        {
            return redirect()->route('admin_dashboard');
        }
        else
        {
            return back()->with('error', 'Please give me a valid password or email');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin_login_form');
    }



    public function dashboard()
    {
        return view('BackEnd.home.admin_home');
    }
}
