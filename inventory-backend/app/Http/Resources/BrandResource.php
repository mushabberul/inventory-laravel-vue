<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'brand_id'=>$this->id,
            'brand_name'=>$this->name,
            'brand_slug'=>$this->slug,
            'brand_image'=>$this->file,
            'brand_status'=>$this->status,
        ];
    }
}
