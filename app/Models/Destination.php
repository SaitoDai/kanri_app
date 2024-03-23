<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;


    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }
}