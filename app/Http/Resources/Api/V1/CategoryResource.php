<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Category */
class CategoryResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cover' => $this->cover,
            'serial_number_web' => $this->serial_number_web,
            'serial_number_mob' => $this->serial_number_mob,
            'name_ru'=>$this->name_ru,
            'name_kz'=>$this->name_kz,
            'name_en'=>$this->name_en,
            'name_cn'=>$this->name_cn
        ];
    }
}
