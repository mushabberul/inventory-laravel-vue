<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class FileUploadedService
{
    public function fileUploaded($request, $path = 'public/upload', $model)
    {

        if (isset($request->file)) {

            $uploaded = $request->file;
            $extention = $uploaded->getClientOriginalExtension();
            $name = $model->id . '.' . $extention;

            //Check old file
            if($model->file != null){
                Storage::delete(env('APP_URL').$model->file);
            }

           $uploaded_url = Storage::putFileAs($path, $uploaded, $name,'public');
           return Storage::url($uploaded_url);

        }
        return;
    }
}
