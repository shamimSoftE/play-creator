<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $banks = \App\Models\BankAccount::all();
        return  view('BackEnd.bank.bank_list',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('BackEnd.bank.bank_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        \App\Models\BankAccount::create($request->all());
        return back()->with('sms', 'Bank Details Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $bank = BankAccount::find($id);
        $bank->update($request->all());
        return back()->with('sms', 'Bank Details Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $bank = BankAccount::find($id);
        $bank->delete();
        return back()->with('sms', 'Bank Details Deleted');
    }

    public function active($id)
    {
        $bank = BankAccount::find($id);
        $bank->status = 1;
        $bank->save();
        return back()->with('sms', 'Bank details available in public');
    }

    public function inactive($id)
    {
        $bank = BankAccount::find($id);
        $bank->status = 0;
        $bank->save();
        return back()->with('sms', 'Bank details unavailable in public');
    }
}
