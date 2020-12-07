<?php

namespace App\Http\Requests\V1\Newspaper;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'=>'required|string',
            'for_all_time_serial_number'=>'required|string',
            'for_year_serial_number'=>'required|string',
            'release_date'=>'required|date',
            'cover'=>'required|string',
            'updatedCover'=>'sometimes|file|mimes:jpg,png,jpeg,gif,svg',
            'newspaper'=>'required|string',
            'updatedNewspaper'=>'sometimes|file|mimes:pdf'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
