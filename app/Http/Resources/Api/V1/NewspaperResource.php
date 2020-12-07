<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Jenssegers\Date\Date;

/** @mixin \App\Models\Newspaper */
class NewspaperResource extends JsonResource
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
            'release_date' => $this->release_date,
            'release_date_carbon'=>Date::parse($this->release_date)->format('j F Y г.'),
            'cover' => $this->cover,
            'newspaper' => $this->newspaper,
            'for_year_serial_number' => $this->for_year_serial_number,
            'for_all_time_serial_number' => $this->for_all_time_serial_number,
        ];
    }
}
