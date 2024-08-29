<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponse;
    function dashboard(){
        $data = [];
        $data['brand_count'] = Brand::count();
        $data['category_count'] = Category::count();
        $data['product_count'] = Product::count();
        $data['customar_count'] = User::customar()->count();
        $data['supplier_count'] = User::supplier()->count();

        return $this->success('Dashboard Info',$data);
    }
}
