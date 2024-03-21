<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Auth;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $buyers = Buyer::all();
        return view('buyers.index', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buyer = new Buyer();
        $buyer->name = $request->input('name');
        $buyer->postal = $request->input('postal');
        $buyer->prefecture = $request->input('prefecture');
        $buyer->address = $request->input('address');
        $buyer->email = $request->input('email');
        $buyer->phone = $request->input('phone');
        $buyer->remark = $request->input('name');
        $buyer->created_by = Auth::user()->name;
        $buyer->count = 0;
        $buyer->save();

        $buyers = Buyer::all();
        return redirect()->route('buyers.index')->with('flash_message', '注文主を登録しました。')->with(compact('buyers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        return view('buyers.show', compact('buyer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $buyer)
    {
        return view('buyers.edit', compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyer $buyer)
    {
        $buyer->name = $request->input('name');
        $buyer->postal = $request->input('postal');
        $buyer->prefecture = $request->input('prefecture');
        $buyer->address = $request->input('address');
        $buyer->email = $request->input('email');
        $buyer->phone = $request->input('phone');
        $buyer->remark = $request->input('name');
        $buyer->updated_by = Auth::user()->name;
        $buyer->update();
        return redirect()->route('buyers.show', $buyer)->with('flash_message', '注文主情報を変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer)
    {   
        $buyers = Buyer::all();
        $buyer->delete();
        return redirect()->route('buyers.index')->with('flash_message', '注文主「' . $buyer->name . '」を削除しました。')->with(compact('buyers'));
    }


    public function softDelete(Buyer $buyer)
    {   
        $buyers = Buyer::all();
        $buyer->deleted_at = now();
        $buyer->update();
        return redirect()->route('buyers.index')->with('flash_message', '注文主「' . $buyer->name . '」を削除しました。')->with(compact('buyers'));
    }
}
