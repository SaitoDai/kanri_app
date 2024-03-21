<?php

namespace App\Http\Controllers;

use App\Models\ItemDetail;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Item $item)
    {
        return view('items.createOption', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Item $item)
    {
        $item_detail = new ItemDetail();
        $item_detail->name = $request->input('name');
        $item_detail->quantity = $request->input('quantity');
        $item_detail->item_id = $item->id;

        $item_detail->save();
        return redirect()->route('items.indexOption', $item_detail->item_id)->with('flash_message', 'オプションを登録しました。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemDetail  $item_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemDetail $item_detail)
    {
        return view('items.editOption', compact('item_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemDetail  $item_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemDetail $item_detail)
    {
        /*$item_detail->item_id = 1;*/
        $item_detail->name = $request->input('name');
        $item_detail->quantity = $request->input('quantity');
        $item_detail->update();
        return redirect()->route('items.indexOption', $item_detail->item_id)->with('flash_message', 'オプションを登録しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemDetail  $item_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemDetail $item_detail)
    {
        //
    }
}
