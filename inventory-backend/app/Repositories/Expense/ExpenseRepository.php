<?php

namespace App\Repositories\Expense;

use Illuminate\Support\Str;
use App\Models\Expense;
use App\Service\FileUploadedService;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Expense\ExpenseInterface;


class ExpenseRepository implements ExpenseInterface
{
    protected $file_path = 'public/expense';

    /**
     * @return Mixed
     */
    public function all()
    {
        $data = Expense::with('expenseCategory','staff')
        ->latest()
        ->get();
        return $data;
    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function allWithPagination($per_page){
        $data = Expense::with('expenseCategory','staff')

        ->latest('id')
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
        $data = Expense::create([
            'expense_category_id' => $request_data->expense_category_id,
            'staff_id' => $request_data->staff_id,
            'amount' => $request_data->amount,
            'note' => $request_data->note,

        ]);
        $image_path = (new FileUploadedService())->fileUploaded($request_data,$this->file_path,$data);

        $data->update([
            'file'=>$image_path,
        ]);

        return $data;
    }

    /**
     * @param int $id
     * @return Mixed
     */
    public function show($id)
    {
        $data = Expense::findOrFail($id);
        return $data;
    }

    /**
     * @param array $request_data
     * @param int $id
     * @return Mixed
     */
    public function update($request_data, $id)
    {
        $data = Expense::findOrFail($id);
        $request_data = (object)$request_data;

        $data->update([
           'expense_category_id' => $request_data->expense_category_id,
            'staff_id' => $request_data->staff_id,
            'amount' => $request_data->amount,
            'note' => $request_data->note,

        ]);

        $image_path = (new FileUploadedService())->fileUploaded($request_data,$this->file_path,$data);
        $data->update([
            'file'=>$image_path
        ]);

        return $data;
    }
}
