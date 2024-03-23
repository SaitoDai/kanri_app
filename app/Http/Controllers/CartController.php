<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Buyer;
use App\Models\Destination;
use App\Models\OrderBuyer;
use App\Models\OrderDestination;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::all();
        $buyers = Buyer::all();
        $destinations = Destination::all();
        return view('carts.index', compact('carts', 'buyers', 'destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart_detail = new CartDetail();
        $cart_detail->item_id = $request->input('item_id');
        $cart_detail->item_detail_id = $request->input('item_detail_id');
        $cart_detail->price = $request->input('price');
        $cart_detail->quantity = $request->input('quantity'); //カートに入力個数を移す
        if($request->input('quantity') > $cart_detail->itemDetail->quantity){
            return redirect()->route('items.show', $request->input('item_id'))->with('flash_message', 'エラー！入力個数を確認してください。');
        } else {
        $cart_detail->itemDetail->quantity -= $cart_detail->quantity; //在庫数の減り(ItemDetailのインスタンス)
        //Cartのidを生成するため一旦カートのインスタンスを作る。
        $cart = new Cart();
        $cart->buyer_id = $request->input('buyer_id');
        $cart->user_id = Auth::id();
        $cart->save();
        //CartとCartDetailを紐づける。
        $cart_detail->cart_id = $cart->id;
        $cart_detail->save();
        //Itemの在庫数を減らした分を更新。
        $cart_detail->itemDetail->update();

        return redirect()->route('items.show', $cart_detail->item_id)->with('flash_message', $cart_detail->item->name . '(' . $cart_detail->itemDetail->name . ')' . 'をカートに入れました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cart $cart, CartDetail $cart_detail)
    {   
        if($request->input('buyer_id') == null || $request->input('buyer_id') == 0){
            return redirect()->route('carts.index')->with('flash_message', '注文主を選択してください。'); //javascriptでalert出したい。
        } else {
            $buyer_id = $request->input('buyer_id');
            $carts = Cart::where('buyer_id', $buyer_id)->get();
            $buyer = Buyer::find($buyer_id);
            $tax = 0;
            $total = 0;
            foreach($carts as $cart){
                $total += $cart->cartDetail->price * $cart->cartDetail->quantity;
            }  
            $tax = $total / 10;       
            $buyer_name= $buyer->name;
            return view('carts.show', compact('buyer_id', 'buyer', 'buyer_name', 'carts', 'total', 'tax'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {   
        $carts = Cart::all();
        $buyers = Buyer::all();
        return view('carts.edit', compact('carts', 'cart', 'buyers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartDetail $cart_detail)
    {  
        if($request->input('quantity') > $cart_detail->itemDetail->quantity)
        {
          return redirect()->route('carts.edit')->with('flash_message', 'エラー：入力個数を確認してください。');
        } else {
          $cart_detail->quantity = $request->input('quantity');
          $cart_detail->update();
          return redirect()->route('carts.edit')->with('flash_message', 'カート内を更新しました。');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function delete(Cart $cart)
    {
        $cart_name = $cart->cartDetail->item->name; //flash_message用の変数1
        $cart_detail_name = $cart->cartDetail->itemDetail->name; //flash_message用の変数2
        $cart->cartDetail->itemDetail->quantity += $cart->cartDetail->quantity; //削除した個数を在庫数に戻す
        $cart->cartDetail->itemDetail->update();
        $cart->delete();
        return redirect()->route('carts.index')->with('flash_message', $cart->cartDetail->item->name . '(' . $cart->cartDetail->itemDetail->name . ') をカートから削除しました。');
    }



    public function payment(Request $request) {
        $carts = Cart::where('buyer_id', $request->input('buyer_id'))->get();
        $buyer = Buyer::where('id', $request->input('buyer_id'))->first();
        $destination = Destination::where('id', $request->input('destination_id'))->first();

        foreach($carts as $cart){
        $order = new Order();
        $order->total = $request->input('total+tax');
        $order->order_number = 1;
        $order->user_id = Auth::id();
        $order->buyer_name = Buyer::where('id', $request->input('buyer_id'))->first()->name;
        $order->destination_name = Destination::where('id', $request->input('destination_id'))->first()->name;
        $order->save(); 

        $order_detail = new OrderDetail();
        $order_detail->item_name = $cart->cartDetail->item->name;
        $order_detail->item_detail_name = $cart->cartDetail->itemDetail->name;
        $order_detail->price = $cart->cartDetail->price;
        $order_detail->quantity = $cart->cartDetail->quantity;
        $order_detail->order_id = $order->id;
        $order_detail->save();

        $order_buyer = new OrderBuyer();
        $order_buyer->postal = $buyer->postal;
        $order_buyer->prefecture = $buyer->prefecture;
        $order_buyer->address = $buyer->address;
        $order_buyer->email = $buyer->email;
        $order_buyer->phone = $buyer->phone;
        $order_buyer->order_id = $order->id;
        $order_buyer->save();

        $order_destination = new OrderDestination();
        $order_destination->name = $destination->name;
        $order_destination->postal = $destination->postal;
        $order_destination->prefecture = $destination->prefecture;
        $order_destination->address = $destination->address;
        $order_destination->email = $destination->email;
        $order_destination->phone = $destination->phone;
        $order_destination->order_id = $order->id;
        $order_destination->save();
        }

        $buyer->count += 1;
        $buyer->update();

        $carts = Cart::where('buyer_id', $request->input('buyer_id'))->get();
        foreach($carts as $cart){
            $cart->delete();
        }
        return redirect()->route('carts.index')->with('flash_message', $order->buyer_name . 'の決済を確定しました。');
    }


    //使わないかも↓
    public function buyerList($id){
        $cart_list = Cart::where('buyer_id', $id)->get(); //id は buyer の id
        return response()->json(
            $cart_list,
            200,
            [],
            JSON_UNESCAPED_UNICODE,
        );
    }
    //使わないかも↑
}
