<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    public function scopeActive($query){
    return $query->where('status',1);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function supplier(){
        return $this->belongsTo(User::class,'supplier_id','id');
    }


}
