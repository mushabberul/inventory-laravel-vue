<?php

namespace App\Repositories\Customer;

use Illuminate\Support\Str;
use App\Models\User as Customer;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Customer\CustomerInterface;


class CustomerRepository implements CustomerInterface
{
    /**
     * @return Mixed
     */
    public function all()
    {

        $data = Customer::customer()
        ->latest()
        ->get();
        return $data;
    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function allWithPagination($per_page){
        $data = Customer::customer()
        ->latest('id')
        ->when(request('search'),function($query){
            $query->where('name','like','%'.request('search').'%');
        })
        ->paginate($per_page);
        return $data;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function status($id){
        $data = Customer::findOrFail($id);

        if($data->status == 1){
            $data->status = 0;
            $data->save();
        }else if($data->status == 0){
            $data->status = 1;
            $data->save();
        }

        return $data;
    }

    /**
     * @param array
     * @return Mixed
     */
    public function store($request_data)
    {
        $request_data = (object)$request_data;
        $data = Customer::create([
            'role_id' => Customer::CUSTOMER,
            'name' => $request_data->name,
            'email' => $request_data->email,
            'phone' => $request_data->phone,
            'password' => Hash::make('password'),
        ]);

        // dd($request_data);

        return $data;
    }

    /**
     * @param int $id
     * @return Mixed
     */
    public function show($id)
    {
        $data = Customer::findOrFail($id);
        return $data;
    }

    /**
     * @param array $request_data
     * @param int $id
     * @return Mixed
     */
    public function update($request_data, $id)
    {
        $request_data =(object)$request_data;
        $data = Customer::findOrFail($id);
        $data->update([
            'role_id' => Customer::CUSTOMER,
            'name' => $request_data->name,
            'email' => $request_data->email,
            'phone' => $request_data->phone,
            'password' => Hash::make('password'),

        ]);

        return $data;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $data = $this->show($id);
        $data->delete();
        return true;
    }


}
