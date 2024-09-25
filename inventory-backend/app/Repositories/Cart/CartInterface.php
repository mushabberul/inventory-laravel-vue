<?php
namespace App\Repositories\Cart;

interface CartInterface{
   public function carts();
   public function addToCart($data);
   public function RemoveCartItem($id);
   public function increaseCartItem($id);
   public function decreaseCartItem($id);
}
