<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Jenssegers\Date\Date;

/** @mixin \App\Models\BannerWeb */
class BannerWebResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'link' => $this->link,
            'disposition' => new BannerDispositionResource($this->whenLoaded('disposition')),
            'disposition_id'=>$this->disposition_id,
            'serialNumber' => new BannerSerialNumberResource($this->whenLoaded('serial_number')),
            'serial_number_id'=>$this->serial_number_id,
            'limit' => new BannerLimitResource($this->whenLoaded('limit')),
            'limit_id'=>$this->limit_id,
            'must_seen'=>$this->must_seen,
            'seen'=>is_null($this->seen)?0:$this->seen,
            'category'=> new CategoryResource($this->whenLoaded('category')),
            'category_id'=>$this->category_id,
            'date_st' => $this->date_st,
            'date_st_string'=>Date::parse($this->date_st)->format('j F Y г.'),
            'date_en' => $this->date_en,
            'date_en_string'=>Date::parse($this->date_en)->format('j F Y г.'),
            'cover' => $this->cover,
        ];
    }
}
