<?php

namespace App\Repositories\Cart;

use Illuminate\Support\Str;
use App\Models\Cart;
use App\Repositories\Cart\CartInterface;


class CartRepository implements CartInterface
{
    /**
     * @return Mixed
     */
    public function carts()
    {
        $data = Cart::with('product')
        ->latest()
        ->get();
        return $data;
    }

    /**
     * @param array
     * @return Mixed
     */
    public function addToCart($request_data)
    {

        $request_data = (object)$request_data;
        $already_add_cart = Cart::where('product_id',$request_data->product_id)->first();

        if($already_add_cart != null){
            $already_add_cart->update([
                'qty' =>  $already_add_cart->qty += $request_data->qty,
                'subtotal' =>  $request_data->qty * $request_data->subtotal,
            ]);
            return $already_add_cart;
        }else{
            $data = Cart::create([
                'product_id' => $request_data->product_id,
                'product_name' => $request_data->product_name,
                'qty' => $request_data->qty,
                'subtotal' => $request_data->subtotal,
                'price' => $request_data->price,

            ]);
            return $data;
        }

    }

    /**
     * @param int $id
     * @return Mixed
     */
    public function RemoveCartItem($id)
    {
        $data = Cart::findOrFail($id)->delete();
        return true;
    }

    public function increaseCartItem($id){
        $data = Cart::findOrFail($id);
        $data->increment('qty');
        $data->update([
            'subtotal'=>$data->qty * $data->price
        ]);
        return $data;
    }

    public function decreaseCartItem($id){
        $data = Cart::findOrFail($id);
         $data->decrement('qty');
         $data->update([
            'subtotal'=>$data->qty * $data->price
        ]);
        return $data;
    }

}
