<?php

namespace App\Repositories\Salary;

use App\Models\Salary;
use App\Models\User;
use App\Notifications\SalaryPaid;
use Illuminate\Support\Str;
use App\Service\FileUploadedService;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Salary\SalaryInterface;
use App\Service\BarCodeService;
use App\Service\QrCodeService;
use Illuminate\Support\Facades\Notification;

class SalaryRepository implements SalaryInterface
{
    protected $file_path = 'public/salary';

    /**
     * @return Mixed
     */
    public function all()
    {
        $data = Salary::with('staff')
        ->latest()
        ->get();
        return $data;
    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function allWithPagination($per_page){
        $data = Salary::with('staff')
        ->when(request('search'),function($query){
            $query->where('type','like','%'.request('search').'%');
        })
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
        $data = Salary::create([
            'staff_id' => $request_data->staff_id,
            'date' => $request_data->date,
            'month' => $request_data->month,
            'year' => $request_data->year,
            'amount' => $request_data->amount,
            'type' => $request_data->type

        ]);

        $staff = User::find($data->staff_id);
        $admins = User::admin()->get();
        $details = [
            'subject' => "Salary Disbursed for the $data->month / $data->year",
            'message' => "Dear $staff->name, your salary for the month: $data->month / $data->year has been disbursed.
            Please collect the cheque from accounts department"
        ];
        Notification::send($staff, new SalaryPaid($details));
        Notification::send($admins, new SalaryPaid($details));

        return $data;
    }

    /**
     * @param int $id
     * @return Mixed
     */
    public function show($id)
    {
        $data = Salary::findOrFail($id);
        return $data;
    }

    /**
     * @param array $request_data
     * @param int $id
     * @return Mixed
     */
    public function update($request_data, $id)
    {
        $data = Salary::findOrFail($id);
        $request_data = (object)$request_data;

        $data->update([
            'staff_id' => $request_data->staff_id,
            'date' => $request_data->date,
            'month' => $request_data->month,
            'year' => $request_data->year,
            'amount' => $request_data->amount,
            'type' => $request_data->type
        ]);

         /* Send Notifications to Staff and Admin */
         $staff = User::find($request_data->staff_id);
         $admins = User::admin()->get();

         $details = [
             'subject' => "Salary Disbursed for the $data->month / $data->year",
             'message' => "Dear $staff->name, your salary for the month: $data->month / $data->year has been disbursed.
             Please collect the cheque from accounts department"
         ];

         Notification::send($staff, new SalaryPaid($details));
         Notification::send($admins, new SalaryPaid($details));

        return $data;
    }
}
