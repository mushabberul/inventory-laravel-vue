<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory,SoftDeletes;

     protected $guarded = ['id'];

     function order_details(){
        return $this->hasMany(OrderDetails::class);
     }
}
