<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;


    public function item(){
        return $this->belongsTo(Item::class);
    }


    public function itemDetail(){
        return $this->belongsTo(ItemDetail::class);
    }


    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }


    public function destination(){
        return $this->buyer->destination();
    }
}
