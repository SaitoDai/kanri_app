<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    use HasFactory;



    public function item(){
        return $this->belongsTo(Item::class);
    }


    public function cartdetail(){
        return $this->hasOne(CartDetail::class);
    }
}
