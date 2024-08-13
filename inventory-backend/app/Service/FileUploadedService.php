<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class FileUploadedService
{
    public function fileUploaded($request, $path = 'public/upload', $model)
    {
        if ($request->image) {
            $uploaded = $request->image;
            $extention = $uploaded->getClientOriginalExtension();
            $name = $model->id . '.' . $extention;

           $uploaded_url = Storage::putFileAs($path, $uploaded, $name,'public');
           return Storage::url($uploaded_url);

        }
        return;
    }
}
