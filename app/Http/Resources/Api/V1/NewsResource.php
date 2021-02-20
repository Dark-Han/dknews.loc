<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Jenssegers\Date\Date;

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
            'title' => [
                'ru' => $this->title_ru,
                'kz' => $this->title_kz,
                'en' => $this->title_en,
            ],
            'text' => [
                'ru' => $this->text_ru,
                'kz' => $this->text_kz,
                'en' => $this->text_en
            ],
            'category' => new CategoryResource($this->whenLoaded('category')),
            'disposition' => new DispositionResource($this->whenLoaded('disposition')),
            'date_st' => $this->date_st,
            'date_st_str'=>Date::parse($this->date_st)->format('j F Y (H:i)'),
            'date_en' => $this->date_en,
            'date_en_str'=>Date::parse($this->date_en)->format('j F Y (H:i)'),
            'seen' => $this->seen,
            'must_seen' => $this->must_seen,
            'limit' => new LimitResource($this->whenLoaded('limit')),
            'foreverStr' => $this->forever?'Да':'Нет',
            'forever'=>$this->forever,
            'cover' => $this->cover
        ];
    }
}
