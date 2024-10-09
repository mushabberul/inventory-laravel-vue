<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Salary;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use ApiResponse;
    function dashboard(){
        $data = [];
        $months_list = [];
        $data['brand_count'] = Brand::count();
        $data['category_count'] = Category::count();
        $data['product_count'] = Product::count();
        $data['customer_count'] = User::customer()->count();
        $data['supplier_count'] = User::supplier()->count();
        $data['sale_count'] = Order::count();

        /* Month wise Expense */
        for ($i = 1; $i <= 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1, date('Y')));
            array_push($months_list, $month);
        }
        $data['stats'] = [];
        foreach ($months_list as $key => $month) {
            $expense = Expense::whereMonth('created_at', $key+1)->sum('amount');
            $sales = Order::whereMonth('created_at', $key+1)->sum('total');
            $salary = Salary::whereMonth('created_at', $key+2)->sum('amount');
            array_push($data['stats'], [
                'month' => $month,
                'expense' => $expense,
                'sales' => $sales,
                'salary' => $salary,
            ]);
        }

        return $this->success('Dashboard Info',$data);
    }


}
