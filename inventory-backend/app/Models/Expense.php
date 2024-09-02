<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Expense extends Model
{
    use HasFactory,SoftDeletes;

     protected $guarded = ['id'];

     function expense_category(){
        return $this->belongsTo(ExpenseCategory::class,'expense_category_id','id');
     }
     function staff(){
        return $this->belongsTo(User::class,'staff_id','id');
     }
}
