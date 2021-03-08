<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Media */
class MediaResource extends JsonResource
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
            'size_id' => (int)$this->size_id,
            'link_count_id' => (int)$this->link_count_id,
            'link_name1' => $this->link_name1,
            'link1' => $this->link1,
            'link_name2' => is_null($this->link_name2)?'':$this->link_name2,
            'link2' => is_null($this->link2)?'':$this->link2,
            'link_name3' => is_null($this->link_name3)?'':$this->link_name3,
            'link3' => is_null($this->link3)?'':$this->link3,
            'cover' => $this->cover,
        ];
    }
}
