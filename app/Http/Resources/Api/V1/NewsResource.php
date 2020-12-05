<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\V1\DispositionResource;
use App\Http\Resources\Api\V1\LimitResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class NewsResource
 * @package App\Http\Resources\Api\V1
 */
class NewsResource extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category_id' => $this->category_id,
            'text' => $this->text,
            'disposition_id' => DispositionResource::collection($this->whenLoaded('dispositions')),
            'date_st' => $this->date_st,
            'date_en' => $this->date_en,
            'seen' => $this->seen,
            'must_seen' => $this->must_seen,
            'limit_id' => LimitResource::collection($this->whenLoaded('limits')),
            'forever' => $this->forever,
            'cover' => $this->cover,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
