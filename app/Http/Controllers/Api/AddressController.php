<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function address($postal){
        $address = Address::where('postal', intval($postal))->first();
        return response()->json(
            $address,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
