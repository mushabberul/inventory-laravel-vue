<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Repositories\Cart\CartInterface;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    private $cartRepository;
    use ApiResponse;

    function __construct(CartInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @param int $par_page
     */
    public function carts()
    {
        $data = $this->cartRepository->carts();
        $metadata['subtotal'] = Cart::sum('subtotal');
        $metadata['count'] = Cart::count();
        return $this->success('Cart List', $data, $metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addToCart(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'product_name' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'subtotal' => 'required',
        ])->validate();


        $data = $this->cartRepository->addToCart($validated);
        return $this->success('Cart Create Successfully',$data);
    }

    /**
     * Display the specified resource.
     */
    public function RemoveCartItem(string $id)
    {
        $data = $this->cartRepository->RemoveCartItem($id);
        return $this->success('Item Remove from Cart', $data);
    }
    /**
     * Display the specified resource.
     */
    public function increaseCartItem(string $id)
    {
        $data = $this->cartRepository->increaseCartItem($id);
        return $this->success('Item Remove from Cart', $data);
    }
    /**
     * Display the specified resource.
     */
    public function decreaseCartItem(string $id)
    {
        $data = $this->cartRepository->decreaseCartItem($id);
        return $this->success('Item Remove from Cart', $data);
    }


}
