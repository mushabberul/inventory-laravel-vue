<?php

namespace App\Http\Controllers\Api;


use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Product\ProductInterface;

class ProductController extends Controller
{
    private $productRepository;
    use ApiResponse;

    function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = request('per_page');
        $data = $this->productRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Product List', $data, $metadata);
    }
    /**
     * @param int $par_page
     */
    public function allProducts()
    {
        $data = $this->productRepository->all();
        $metadata['count'] = count($data);
        return $this->success('Product List', $data, $metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'supplier_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'original_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'code' => 'required|string|max:255|unique:products,code',
            'barcode' => 'nullable|string',
            'qrcode' => 'nullable|string',
            'file'=>'nullable'
        ])->validate();


        $data = $this->productRepository->store($validated);
        return $this->success('Product Create Successfully', (new ProductResource($data)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->productRepository->show($id);
        return $this->success('Product Data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'supplier_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'code' => 'required|string',
            'barcode' => 'nullable|string',
            'qrcode' => 'nullable|string',
            'file'=>'nullable'
        ])->validate();


        $data = $this->productRepository->update($validated, $id);
        return $this->success('Product Create Successfully', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->productRepository->delete($id);
        return $this->success('Product Deleted Successfully');
    }
    /**
     * Change status resource from storage.
     */
    public function status(string $id)
    {
        $data = $this->productRepository->status($id);
        return $this->success('Product Status Updated Successfully', $data);
    }
}
