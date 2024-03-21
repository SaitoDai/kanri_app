<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemDetail;

class QuantityController extends Controller
{
    public function quantity($id){
        $quantity = ItemDetail::where('id', intval($id))->first();
        return response()->json(
            $quantity,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
