<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }


    public function destination(){
        return $this->belongsTo(Destination::class);
    }



    public function orderDetail(){
        return $this->hasOne(OrderDetail::class);
    }


    public function orderBuyer(){
        return $this->hasOne(OrderBuyer::class);
    }


    public function orderDestination(){
        return $this->hasOne(OrderDestination::class);
    }
}
