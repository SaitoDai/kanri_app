<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAcceptController extends Controller
{
    public function index(){
        $query = \App\User::query();

        return $query->get();
    }


    public function accept(Request $request) {

        $user = \App\User::find($request->user_id);
        $user->accepted = $request->accept;
        $result = $user->save();
        return ['result' => $result];

    }
}
