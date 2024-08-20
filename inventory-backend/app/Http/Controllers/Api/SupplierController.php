<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Supplier\SupplierInterface;

class SupplierController extends Controller
{
    private $supplierRepository;
    use ApiResponse;

    function __construct(SupplierInterface $supplierRepository)
    {

        $this->supplierRepository = $supplierRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = request('per_page');
        $data = $this->supplierRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Supplier List', $data, $metadata);
    }
    /**
     * @param int $par_page
     */
    public function allSuppliers()
    {
        $data = $this->supplierRepository->all();
        $metadata['count'] = count($data);
        return $this->success('Supplier List', $data, $metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'nid' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'file'=>'nullable'
        ])->validate();


        $data = $this->supplierRepository->store($validated);
        return $this->success('Supplier Create Successfully', (new SupplierResource($data)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->supplierRepository->show($id);
        return $this->success('Supplier Data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'nid' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',

        ])->validate();


        $data = $this->supplierRepository->update($validated, $id);
        return $this->success('Supplier Create Successfully', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->supplierRepository->delete($id);
        return $this->success('Supplier Deleted Successfully');
    }
    /**
     * Change status resource from storage.
     */
    public function status(string $id)
    {
        $data = $this->supplierRepository->status($id);
        return $this->success('Supplier Status Updated Successfully', $data);
    }
}
