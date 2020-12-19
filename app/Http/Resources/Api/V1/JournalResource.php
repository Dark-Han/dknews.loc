<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Jenssegers\Date\Date;
use App\Http\Resources\Api\V1\JournalTypeResource;

/** @mixin \App\Models\Journal */
class JournalResource extends JsonResource
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
            'journal_type_id' => $this->journalTypes->id,
            'type' => $this->journalTypes->name,
            'release_date' => $this->release_date,
            'release_date_jFY' => Date::parse($this->release_date)->format('j F Y г.'),
            'cover' => $this->cover,
            'journal' => $this->journal,
            'for_year_serial_number' => $this->for_year_serial_number,
            'for_all_time_serial_number' => $this->for_all_time_serial_number,
        ];
    }
}
