<?php
namespace App\Service;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService{
    public function QrCodeGenerate($model,$path='public/uploads'){
       $image = QrCode::format('svg')
        ->size(600)
        ->errorCorrection('H')
        ->generate($model->code);

        $qrcodePath = Storage::put($path.'/'.$model->id.'.svg',$image,'public');

        return Storage::url($path.'/'.$model->id.'.svg');
    }
}
