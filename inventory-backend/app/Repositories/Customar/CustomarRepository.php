<?php

namespace App\Repositories\Customar;

use Illuminate\Support\Str;
use App\Models\User as Customar;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Customar\CustomarInterface;


class CustomarRepository implements CustomarInterface
{
    /**
     * @return Mixed
     */
    public function all()
    {
        $data = Customar::customar()
        ->latest()
        ->get();
        return $data;
    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function allWithPagination($per_page){
        $data = Customar::customar()
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
        $data = Customar::findOrFail($id);

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
        $data = Customar::create([
            'role_id' => Customar::CUSTOMAR,
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
        $data = Customar::findOrFail($id);
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
        $data = Customar::findOrFail($id);
        $data->update([
            'role_id' => Customar::CUSTOMAR,
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
