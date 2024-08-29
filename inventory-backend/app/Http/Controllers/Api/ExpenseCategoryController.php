<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseCategoryResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ExpenseCategory\ExpenseCategoryInterface;

class ExpenseCategoryController extends Controller
{
    private $expenseCategoryRepository;
    use ApiResponse;

    function __construct(ExpenseCategoryInterface $expenseCategoryRepository)
    {

        $this->expenseCategoryRepository = $expenseCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = request('per_page');
        $data = $this->expenseCategoryRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('ExpenseCategory List', $data, $metadata);
    }
    /**
     * @param int $par_page
     */
    public function allExpenseCategorys()
    {
        $data = $this->expenseCategoryRepository->all();
        $metadata['count'] = count($data);
        return $this->success('ExpenseCategory List', $data, $metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',

        ])->validate();


        $data = $this->expenseCategoryRepository->store($validated);
        return $this->success('ExpenseCategory Create Successfully',$data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->expenseCategoryRepository->show($id);
        return $this->success('ExpenseCategory Data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',


        ])->validate();


        $data = $this->expenseCategoryRepository->update($validated, $id);
        return $this->success('ExpenseCategory Create Successfully', $data);
    }
}
