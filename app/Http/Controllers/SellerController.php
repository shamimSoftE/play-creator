<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::latest()->get();
        return view('BackEnd.seller.seller_list',compact('sellers'));
    }

    public function create()
    {
        return view('FrontEnd.seller.seller_request');
    }

    protected function Img($request)
    {
        if($request->hasFile('image')){

            $img_tmp = $request->file('image');

            if ($img_tmp->isValid()){
//                $img_exten = $img_tmp->getClientOriginalExtension();
                $img_name = $img_tmp->getClientOriginalName();
                $img_path = public_path('Back/images/seller');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }

    protected function NID_img($request)
    {
        if($request->hasFile('nid_image')){

            $img_tmp = $request->file('nid_image');

            if ($img_tmp->isValid()){
                $img_name = $img_tmp->getClientOriginalName();
                $img_path = public_path('Back/images/seller');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'address' => 'required',
           'nid' => 'required|min:9|max:13',
           'image' => 'required',
           'nid_image' => 'required'
        ]);

        $user = auth()->user()->id;

        $image_name = $this->Img($request);
        $nid_img = $this->NID_img($request);


        Seller::create([
            'name' => $request->name,
            'nid' => $request->nid,
            'address' => $request->address,
            'image' => $image_name,
            'nid_image' => $nid_img,
            'user_id' => $user,
        ]);
        return redirect()->route('user_profile')->with('success','Thanks for your request. We will contact you soon.');
    }

    public function update(Request $request)
    {

       /* $img_tmp = $request->file('image');

        if ($img_tmp)
        {
            $img_exten = $img_tmp->getClientOriginalExtension();
            $img_name = $img_tmp->getClientOriginalName().'.'.$img_exten;
            $img_path = public_path('Back/images/category');
            $img_tmp->move($img_path,$img_name);

            $old_img = $seller->image;

            if(file_exists($old_img)){
                unlink($old_img);
            }
            $seller->name = $request->name;
            $seller->image = $img_name;
        }else{
            $seller->name = $request->name;
        }

        $seller->save();
        return back()->with('sms','Category updated');*/
    }

    public function destroy($id)
    {
        $seller = Seller::find($id);
        $seller->delete();
        return back()->with('sms','Seller Deleted');
    }

    public function active($id)
    {
        $seller = Seller::find($id);
        $seller->status = 1;
        $seller->save();
        return back()->with('sms','Seller Approved');
    }

    public function Inactive($id)
    {
        $seller = Seller::find($id);
        $seller->status = 0;
        $seller->save();
        return back()->with('sms','Seller goes to  pending mode');
    }


}
