<?php

namespace App\Http\Requests\V1\BannerWeb;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'=>'required|string',
            'link'=>'required|string',
            'disposition_id'=>'required|integer',
            'serial_number_id'=>'required|integer',
            'limit_id'=>'required|integer',
            'category_id'=>'required|integer',
            'date_st'=>'date_format:Y-m-d',
            'date_en'=>'date_format:Y-m-d',
            'cover'=>'required|string',
            'updatedCover'=>'sometimes|file|mimes:jpg,png,jpeg,gif,svg'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
