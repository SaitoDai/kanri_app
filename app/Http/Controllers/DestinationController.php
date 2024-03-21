<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Auth;

class DestinationController extends Controller
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
    public function create($buyer_id)
    {
        $buyers = Buyer::all();
        return view('destinations.create', compact('buyers', 'buyer_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $destination = new Destination();
        $destination->name = $request->input('name');
        $destination->postal = $request->input('postal');
        $destination->prefecture = $request->input('prefecture');
        $destination->address = $request->input('address');
        $destination->email = $request->input('email');
        $destination->phone = $request->input('phone');
        $destination->remark = $request->input('name');
        $destination->user_id = Auth::id();
        $destination->buyer_id = $request->input('buyer_id');;
        $destination->save();

        return redirect()->route('buyers.show', $destination->buyer_id)->with('flash_message', '納品先を登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        return view('destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        return view('destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {
        $destination->name = $request->input('name');
        $destination->postal = $request->input('postal');
        $destination->prefecture = $request->input('prefecture');
        $destination->address = $request->input('address');
        $destination->email = $request->input('email');
        $destination->phone = $request->input('phone');
        $destination->remark = $request->input('name');
        $destination->user_id = Auth::id();
        $destination->update();

        return redirect()->route('destinations.show', $destination)->with('flash_message', '納品先を編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Destination $destination)
    {
        $buyer_id = $request->input('buyer_id');
        $destination->delete();
        return redirect()->route('buyers.show', $buyer_id)->with('flash_message', '納品先「' . $destination->name . '」を削除しました。');
    }
}
