<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StaffResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Staff\StaffInterface;

class StaffController extends Controller
{
    private $staffRepository;
    use ApiResponse;

    function __construct(StaffInterface $staffRepository)
    {

        $this->staffRepository = $staffRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = request('per_page');
        $data = $this->staffRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Staff List', $data, $metadata);
    }
    /**
     * @param int $par_page
     */
    public function allStaffs()
    {
        $data = $this->staffRepository->all();
        $metadata['count'] = count($data);
        return $this->success('Staff List', $data, $metadata);
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
            'file'=>'nullable'
        ])->validate();


        $data = $this->staffRepository->store($validated);
        return $this->success('Staff Create Successfully', (new StaffResource($data)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->staffRepository->show($id);
        return $this->success('Staff Data', $data);
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

        ])->validate();


        $data = $this->staffRepository->update($validated, $id);
        return $this->success('Staff Create Successfully', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->staffRepository->delete($id);
        return $this->success('Staff Deleted Successfully');
    }
    /**
     * Change status resource from storage.
     */
    public function status(string $id)
    {
        $data = $this->staffRepository->status($id);
        return $this->success('Staff Status Updated Successfully', $data);
    }
}
