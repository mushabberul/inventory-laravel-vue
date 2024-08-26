<?php

namespace App\Repositories\Product;

use Illuminate\Support\Str;
use App\Models\Product;
use App\Service\FileUploadedService;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Product\ProductInterface;
use App\Service\BarCodeService;
use App\Service\QrCodeService;

class ProductRepository implements ProductInterface
{
    protected $file_path = 'public/product';
    protected $barcode_path = 'public/product/barcode';
    protected $qrcode_path = 'public/product/qrcode';

    /**
     * @return Mixed
     */
    public function all()
    {
        $data = Product::with('category','brand','supplier')

        ->latest()
        ->get();
        return $data;
    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function allWithPagination($per_page){
        $data = Product::with('category','brand','supplier')

        ->latest('id')
        ->paginate($per_page);
        return $data;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function status($id){
        $data = Product::findOrFail($id);

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
        $data = Product::create([
            'category_id' => $request_data->category_id,
            'brand_id' => $request_data->brand_id,
            'supplier_id' => $request_data->supplier_id,
            'name' => $request_data->name,
            'slug' => Str::slug($request_data->name), // Assuming the table is 'products'
            'original_price' => $request_data->original_price,
            'sell_price' => $request_data->sell_price,
            'stock' => $request_data->stock,
            'description' => $request_data->description,
            'code' => $request_data->code
        ]);
        $image_path = (new FileUploadedService())->fileUploaded($request_data,$this->file_path,$data);
        $bar_path = (new BarCodeService())->generateBarCode($data,$this->barcode_path);
        $qr_path = (new QrCodeService())->QrCodeGenerate($data,$this->qrcode_path);
        $data->update([
            'file'=>$image_path,
            'barcode'=>$bar_path,
            'qrcode'=>$qr_path,
        ]);

        return $data;
    }

    /**
     * @param int $id
     * @return Mixed
     */
    public function show($id)
    {
        $data = Product::findOrFail($id);
        return $data;
    }

    /**
     * @param array $request_data
     * @param int $id
     * @return Mixed
     */
    public function update($request_data, $id)
    {
        $data = Product::findOrFail($id);
        $request_data = (object)$request_data;

        $data->update([
           'category_id' => $request_data->category_id,
            'brand_id' => $request_data->brand_id,
            'supplier_id' => $request_data->supplier_id,
            'name' => $request_data->name,
            'slug' => Str::slug($request_data->name), // Assuming the table is 'products'
            'original_price' => $request_data->original_price,
            'sell_price' => $request_data->sell_price,
            'stock' => $request_data->stock,
            'description' => $request_data->description,
            'code' => $request_data->code
        ]);

        $image_path = (new FileUploadedService())->fileUploaded($request_data,$this->file_path,$data);
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
