<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalaryResource;
use App\Models\Salary;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Salary\SalaryInterface;
use Exception;

class SaralyController extends Controller
{
    private $salaryRepository;
    use ApiResponse;

    function __construct(SalaryInterface $salaryRepository)
    {
        $this->salaryRepository = $salaryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = request('per_page');
        $data = $this->salaryRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Salary List', $data, $metadata);
    }
    /**
     * @param int $par_page
     */
    public function allSalarys()
    {
        $data = $this->salaryRepository->all();
        $metadata['count'] = count($data);
        return $this->success('Salary List', $data, $metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'staff_id' => 'required|exists:users,id',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'amount' => 'required|min:0',
            'type' => 'nullable|string',
        ])->validate();

        try{

            $data = $this->salaryRepository->store($validated);
            return $this->success('Salary Create Successfully', $data);

        }catch(Exception $e){
            dd($e);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->salaryRepository->show($id);
        return $this->success('Salary Data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
           'staff_id' => 'required|exists:users,id',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'amount' => 'required|min:0',
            'type' => 'nullable|string',
        ])->validate();

        $data = $this->salaryRepository->update($validated, $id);
        return $this->success('Salary Create Successfully', $data);
    }

}
