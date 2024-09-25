<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Customer\CustomerInterface;

class CustomerController extends Controller
{
    private $customerRepository;
    use ApiResponse;

    function __construct(CustomerInterface $customerRepository){


        $this->customerRepository = $customerRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $per_page = request('per_page');
        $data = $this->customerRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Customer List',$data,$metadata);

    }
    /**
     * @param int $par_page
     */
    public function allCustomers()
    {
        $data = $this->customerRepository->all();
        $metadata['count']= count($data);
        return $this->success('Customer List',$data,$metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'phone' => 'required',
            'name' =>'nullable|string',
            'email'=>'nullable|email',
        ])->validate();

        $data = $this->customerRepository->store($validated);
        return $this->success('Customer Create Successfully', (new CustomerResource($data)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->customerRepository->show($id);
        return $this->success('Customer Data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = Validator::make($request->all(),[
            'phone' => 'required',
            'name' =>'nullable|string',
            'email'=>'nullable|email',
        ])->validate();


        $data = $this->customerRepository->update($validated,$id);
        return $this->success('Customer Create Successfully',$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->customerRepository->delete($id);
        return $this->success('Customer Deleted Successfully');
    }
    /**
     * Change status resource from storage.
     */
    public function status(string $id)
    {
        $data = $this->customerRepository->status($id);
        return $this->success('Customer Status Updated Successfully',$data);
    }
}
