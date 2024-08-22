<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomarResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Customar\CustomarInterface;

class CustomarController extends Controller
{
    private $customarRepository;
    use ApiResponse;

    function __construct(CustomarInterface $customarRepository){

       
        $this->customarRepository = $customarRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $per_page = request('per_page');
        $data = $this->customarRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Customar List',$data,$metadata);

    }
    /**
     * @param int $par_page
     */
    public function allCustomars()
    {
        $data = $this->customarRepository->all();
        $metadata['count']= count($data);
        return $this->success('Customar List',$data,$metadata);
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

        $data = $this->customarRepository->store($validated);
        return $this->success('Customar Create Successfully', (new CustomarResource($data)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->customarRepository->show($id);
        return $this->success('Customar Data',$data);
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


        $data = $this->customarRepository->update($validated,$id);
        return $this->success('Customar Create Successfully',$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->customarRepository->delete($id);
        return $this->success('Customar Deleted Successfully');
    }
    /**
     * Change status resource from storage.
     */
    public function status(string $id)
    {
        $data = $this->customarRepository->status($id);
        return $this->success('Customar Status Updated Successfully',$data);
    }
}
