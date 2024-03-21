<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;


    public function item(){
        return $this->belongsTo(Item::class);
    }


    public function itemDetail(){
        return $this->belongsTo(ItemDetail::class);
    }


    public function orderBuyer(){
        return $this->hasOne(OrderBuyer::class);
    }
}
