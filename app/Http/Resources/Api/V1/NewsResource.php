<?php

namespace App\Http\Resources\Api\V1;

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
            'category' => new CategoryResource($this->whenLoaded('category')),
            'text' => $this->text,
            'disposition' => new DispositionResource($this->whenLoaded('disposition')),
            'date_st' => $this->date_st,
            'date_en' => $this->date_en,
            'seen' => $this->seen,
            'must_seen' => $this->must_seen,
            'limit' => new LimitResource($this->whenLoaded('limit')),
            'forever' => $this->forever,
            'cover' => $this->cover
        ];
    }
}
