<?php

namespace App\Repositories\Order;

use App\Models\Cart;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User as Customer;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Order\OrderInterface;

class OrderRepository implements OrderInterface
{
    /**
     * @return Mixed
     */
    public function all()
    {
        $data = Order::with('order_details','customer')
            ->latest()
            ->get();
        return $data;
    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function allWithPagination($per_page)
    {
        $data = Order::with('order_details','customer')
            ->when(request('transaction_number'), function ($query) {
                $query->where('transaction_number', request('transaction_number'));
            })
            ->latest('id')
            ->paginate($per_page);
        return $data;
    }
    /**
     * @param array
     * @return Mixed
     */
    public function store($request_data)
    {
        $request_data = (object)$request_data;
   

       // Check Customer Already exists

       $customer_mobile = $request_data->customer_mobile;

       $customer = Customer::customer()->where(['phone' => $customer_mobile])->first();
       if(!$customer){
           $customer = Customer::create([
               'name' => $request_data->customer_name ??'walk in customer',
               'email' => '',
               'role_id' => Customer::CUSTOMER,
               'phone' => $customer_mobile,
               'password' => Hash::make(1234)
           ]);
       }
        $data = Order::create([
            'customer_id' => $customer->id,
            'transaction_number' => 'TXN'.mt_rand(100000,999999),
            'pay_amount' => $request_data->pay_amount,
            'due_amount' => $request_data->due_amount,
            'subtotal' => $request_data->subtotal,
            'discount' => $request_data->discount,
            'total' => $request_data->total,
            'payment_method' => $request_data->payment_method,
        ]);

        $carts = Cart::all();
        foreach($carts as $key=>$item){
            OrderDetails::create([
                'order_id'=>$data->id,
                'product_id'=>$item->product_id,
                'qty'=>$item->qty,
                'price'=>$item->price,
                'subtotal'=>$item->subtotal
            ]);

            Product::find($item->product_id)->decrement('stock',$item->qty);
            $item->delete();
        }

        return $data;
    }

    /**
     * @param int $id
     * @return Mixed
     */
    public function show($id)
    {
        $data = Order::findOrFail($id);
        return $data;
    }
}
