<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $items = Item::all();
        return view('items.index', compact('items', 'categories'));
    }


    public function categorizedIndex(Category $category)
    {   
        $categories = Category::all();
        $items = Item::where('category_id', $category->id)->get();
        return view('items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->category_id = $request->input('category_id');
        $item->remark = $request->input('remark');

        if($request->file('image') != NULL){
            $fileName = $request->file('image')->getClientOriginalName();
            $file = $request->file('image')->storeAs('', $fileName);
            $item->image_path = $fileName;
            }
        //dd($request->file('image'), $item->image_path);
        $item->save();
        return redirect()->route('items.show', $item)->with('flash_message', '商品を登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $buyers = Buyer::all();
        return view('items.show', compact('item', 'buyers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->category_id = $request->input('category_id');
        $item->remark = $request->input('remark');

        if($request->file('image') != NULL){
        $fileName = $request->file('image')->getClientOriginalName();
        $file = $request->file('image')->storeAs('', $fileName);
        $item->image_path = $fileName;
        //dd($request->file('image'), $item->image_path);
        }

        $item->update();
        return redirect()->route('items.show', $item)->with('flash_message', '商品を更新しました。');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $cart_id = CartDetail::where('item_id', $item->id)->first()->cart_id; //cart_detailsテーブルから$item->idを使って削除するカートのレコードidを取得する
        $cart = Cart::where('id', $cart_id)->first()->delete();
        $item->delete();
        return redirect()->route('items.index')->with('flash_message', '「' . $item->name . '」を削除しました。');
    }


    public function indexOption(Item $item){
        $buyers = Buyer::all();
        return view('items.indexOption', compact('item', 'buyers'));
    }
}



