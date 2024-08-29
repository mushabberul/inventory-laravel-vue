<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Expense\ExpenseInterface;

class ExpenseController extends Controller
{
    private $expenseRepository;
    use ApiResponse;

    function __construct(ExpenseInterface $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = request('per_page');
        $data = $this->expenseRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Expense List', $data, $metadata);
    }
    /**
     * @param int $par_page
     */
    public function allExpenses()
    {
        $data = $this->expenseRepository->all();
        $metadata['count'] = count($data);
        return $this->success('Expense List', $data, $metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'expense_category_id' => 'required|exists:expense_categories,id',
            'staff_id' => 'required|exists:users,id',
            'amount' => 'required',
            'note'=>'nullable',
            'file'=>'nullable'
        ])->validate();


        $data = $this->expenseRepository->store($validated);
        return $this->success('Expense Create Successfully',$data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->expenseRepository->show($id);
        return $this->success('Expense Data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'expense_category_id' => 'required|exists:expense_categories,id',
            'staff_id' => 'required|exists:users,id',
            'amount' => 'required',
            'note'=>'nullable',
            'file'=>'nullable'
        ])->validate();

        $data = $this->expenseRepository->update($validated, $id);
        return $this->success('Expense Create Successfully', $data);
    }
}
