<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Order\OrderInterface;

class OrderController extends Controller
{
    private $orderRepository;
    use ApiResponse;

    function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = request('per_page');
        $data = $this->orderRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Order List', $data, $metadata);
    }
    /**
     * @param int $par_page
     */
    public function allOrders()
    {
        $data = $this->orderRepository->all();
        $metadata['count'] = count($data);
        return $this->success('Order List', $data, $metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'customer_mobile' => 'required',
            'pay_amount' => 'required|numeric|min:0',
            'due_amount' => 'required|numeric|min:0',
            'subtotal' => 'required|integer|min:0',
            'discount' => 'required|integer|min:0',
            'total' => 'required|integer|min:0',
           'payment_method'=>'nullable'
        ])->validate();

        $data = $this->orderRepository->store($validated);
        return $this->success('Order Create Successfully', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->orderRepository->show($id);
        return $this->success('Order Data', $data);
    }
}
