<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponse;
    function dashboard(){
        $data = [];
        $data['brand_count'] = Brand::count();
        $data['category_count'] = Category::count();
        $data['product_count'] = Product::count();
        $data['customer_count'] = User::customer()->count();
        $data['supplier_count'] = User::supplier()->count();
        $data['sale_count'] = Order::count();

        return $this->success('Dashboard Info',$data);
    }

    function getNotifications(){
        try{
            $user = auth()->user();
            return $this->success('Dashboard Info',$user->notifications);
        }catch(Exception $e){
            dd($e);
        }

    }
    function makeAsReadAll(){

        $user = auth()->user();
        $user->unreadNotifications()->update(['read_at' => now()]);
        return $this->success('Dashboard Info',$user->unreadNotifications);
    }
}
