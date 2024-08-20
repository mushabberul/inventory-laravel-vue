<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;
use App\Service\FileUploadedService;
use App\Repositories\Brand\BrandInterface;


class BrandRepository implements BrandInterface
{
    protected $path = 'public/brand';

    /**
     * @return Mixed
     */
    public function all()
    {
        $data = Brand::latest()->get();
        return $data;
    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function allWithPagination($per_page){
        $data = Brand::latest('id')
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
        $data = Brand::findOrFail($id);

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
        $data = Brand::create([
            'name' => $request_data->name,
            'code' => $request_data->code,
            'slug' => Str::slug($request_data->name),
        ]);

        // dd($request_data);
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
        $data = Brand::findOrFail($id);
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
        $data = Brand::findOrFail($id);
        $data->update([
            'name' => $request_data->name,
            'code' => $request_data->code,
            'slug' => Str::slug($request_data->name),

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
