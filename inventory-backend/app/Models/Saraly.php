<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Saraly extends Model
{
    use HasFactory,SoftDeletes;

     protected $guarded = ['id'];

     function staff(){
        return $this->belongsTo(User::class,'staff_id','id');
     }
}
