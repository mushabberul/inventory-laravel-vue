<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BrandController extends Model
{
    use HasFactory,SoftDeletes;

     protected $guarded = ['id'];
}
