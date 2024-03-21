<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;


    public function destinations(){
        return $this->hasMany(Destination::class);
    }


    public function carts(){
        return $this->hasMany(Cart::class);
    }


    public function createdBy(){
        return $this->belongsTo(User::class);
    }


        public function updatedBy(){
        return $this->belongsTo(User::class);
    }
}
