<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Brand\BrandInterface;

class BrandController extends Controller
{
    private $brandRepository;
    use ApiResponse;

    function __construct(BrandInterface $brandRepository){

        $this->brandRepository = $brandRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $per_page = request('per_page');
        $data = $this->brandRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Brand List',$data,$metadata);

    }
    /**
     * @param int $par_page
     */
    public function allBrands()
    {
        $data = $this->brandRepository->all();
        $metadata['count']= count($data);
        return $this->success('Brand List',$data,$metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' =>'required|string',
            'code'=>'nullable',
            'file' => 'nullable',
            'status' => 'nullable',
        ])->validate();

        $data = $this->brandRepository->store($validated);
        return $this->success('Brand Create Successfully', (new BrandResource($data)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->brandRepository->show($id);
        return $this->success('Brand Data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = Validator::make($request->all(),[
            'name' =>'required|string',
            'code'=>'nullable',
            'file' => 'nullable',
            'status' => 'nullable',
        ])->validate();


        $data = $this->brandRepository->update($validated,$id);
        return $this->success('Brand Create Successfully',$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->brandRepository->delete($id);
        return $this->success('Brand Deleted Successfully');
    }
    /**
     * Change status resource from storage.
     */
    public function status(string $id)
    {
        $data = $this->brandRepository->status($id);
        return $this->success('Brand Status Updated Successfully',$data);
    }
}
