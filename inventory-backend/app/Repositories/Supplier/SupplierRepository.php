<?php

namespace App\Repositories\Supplier;

use Illuminate\Support\Str;
use App\Models\User as Supplier;
use App\Service\FileUploadedService;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Supplier\SupplierInterface;

class SupplierRepository implements SupplierInterface
{
    protected $path = 'public/supplier';

    /**
     * @return Mixed
     */
    public function all()
    {
        $data = Supplier::latest()->get();
        return $data;
    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function allWithPagination($per_page){
        $data = Supplier::latest('id')
        ->when(request('search'),function($query){
            $query->where('name','like','%'.request('search').'%')
            ->orWhere('email','like','%'.request('search').'%')
            ->orWhere('phone','like','%'.request('search').'%')
            ->orWhere('nid','like','%'.request('search').'%')
            ->orWhere('company_name','like','%'.request('search').'%');
        })
        ->paginate($per_page);
        return $data;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function status($id){
        $data = Supplier::findOrFail($id);

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
        $data = Supplier::create([
            'role_id' => Supplier::SIPPLIER,
            'name' => $request_data->name,
            'email' => $request_data->email,
            'phone' => $request_data->phone,
            'nid' => $request_data->nid,
            'address' => $request_data->address,
            'company_name' => $request_data->company_name,
            'password' => Hash::make('password'),
        ]);
        $image_path = (new FileUploadedService())->fileUploaded($request_data,$this->path,$data);
        $data->update([
            'file'=>$image_path
        ]);

        return $data;
    }

    /**
     * @param int $id
     * @return Mixed
     */
    public function show($id)
    {
        $data = Supplier::findOrFail($id);
        return $data;
    }

    /**
     * @param array $request_data
     * @param int $id
     * @return Mixed
     */
    public function update($request_data, $id)
    {
        $data = Supplier::findOrFail($id);
        $request_data = (object)$request_data;

        $data->update([
           'role_id' => Supplier::ADMIN,
            'name' => $request_data->name,
            'email' => $request_data->email,
            'phone' => $request_data->phone,
            'nid' => $request_data->nid,
            'address' => $request_data->address,
            'company_name' => $request_data->company_name,
            'password' => Hash::make('password'),

        ]);

        $image_path = (new FileUploadedService())->fileUploaded($request_data,$this->path,$data);
        $data->update([
            'file'=>$image_path
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
