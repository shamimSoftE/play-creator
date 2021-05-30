<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Auth;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->get();

        return view('BackEnd.admin-auth.admin_list', compact('admins'));
    }

    public function register()
    {
        return view('BackEnd.admin-auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required|min:8|max:20',
            'password_confirmation' => 'required|same:password',
        ]);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();
        return back()->with('sms', 'Admin Created');
    }

    public function login()
    {
        return view('BackEnd.admin-auth.login');
    }

    public function check(Request $request)
    {
        $verify = $request->all();

        if (Auth::guard('admin')->attempt(['email' => $verify['email'], 'password' => $verify['password']])) {
            return redirect()->route('admin_dashboard');
        } else {
            return back()->with('error', 'Please give me a valid password or email');
        }
    }

    /*============= admin dashboard function start ===================*/

    public function create()
    {
        return view('BackEnd.admin-auth.register');
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

    public function profile($id)
    {
        $admin = Admin::find($id);
        return view('BackEnd.admin-auth.admin_profile',compact('admin'));
    }

    /*protected function Img($request)
    {
        if($request->hasFile('image')){

            $img_tmp = $request->file('image');

            if ($img_tmp->isValid()){
                $img_name = $img_tmp->getClientOriginalName();
                $img_path = public_path('Back/images/admin');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }*/

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|max:20',
            'password_confirmation' => 'required|same:password',
        ]);
        $admin = Admin::find($request->id);

        /*$img_tmp = $this->Img($request);

        if ($img_tmp)
        {
            $old_img = $admin->image;

            if(file_exists($old_img)){
                unlink($old_img);
            }
            $admin->update([
               'name' =>  $request->name,
               'email' =>  $request->email,
               'image' =>  $img_tmp,
               'password' =>  bcrypt($request->password),
            ]);

        }else{*/

//        dd($request->all());
            $admin->update([
                'name' =>  $request->name,
                'email' =>  $request->email,
                'password' =>  bcrypt($request->password),
            ]);

        /*}*/
        return back()->with('sms', 'Admin Information Update');
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return back()->with('sms', 'Admin Deleted');
    }
}
