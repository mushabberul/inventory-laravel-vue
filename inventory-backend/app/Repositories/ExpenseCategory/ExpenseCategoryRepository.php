<?php

namespace App\Repositories\ExpenseCategory;

use Illuminate\Support\Str;
use App\Models\ExpenseCategory;
use App\Service\FileUploadedService;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ExpenseCategory\ExpenseCategoryInterface;

class ExpenseCategoryRepository implements ExpenseCategoryInterface
{
    protected $path = 'public/expenseCategory';

    /**
     * @return Mixed
     */
    public function all()
    {
        $data = ExpenseCategory::latest()->get();
        return $data;
    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function allWithPagination($per_page){
        $data = ExpenseCategory::latest('id')
        ->when(request('search'),function($query){
            $query->where('name','like','%'.request('search').'%');

        })
        ->paginate($per_page);
        return $data;
    }

    /**
     * @param array
     * @return Mixed
     */
    public function store($request_data)
    {
        $request_data = (object)$request_data;
        $data = ExpenseCategory::create([
            'name' => $request_data->name,
            'slug' => Str::slug($request_data->name),
        ]);
        return $data;
    }

    /**
     * @param int $id
     * @return Mixed
     */
    public function show($id)
    {
        $data = ExpenseCategory::findOrFail($id);
        return $data;
    }

    /**
     * @param array $request_data
     * @param int $id
     * @return Mixed
     */
    public function update($request_data, $id)
    {
        $data = ExpenseCategory::findOrFail($id);
        $request_data = (object)$request_data;

        $data->update([
           'name' => $request_data->name,
            'slug' => Str::slug($request_data->name),

        ]);
        return $data;
    }

}
