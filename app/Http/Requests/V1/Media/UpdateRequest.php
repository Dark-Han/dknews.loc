<?php

namespace App\Http\Requests\V1\Media;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'=>'required|string',
            'size_id'=>'required|integer',
            'link_count_id'=>'required|integer',
            'link_name1'=>'required|string',
            'link1'=>'required|string',
            'link_name2'=>'nullable|string',
            'link2'=>'nullable|string',
            'link_name3'=>'nullable|string',
            'link3'=>'nullable|string',
            'cover'=>'required|string',
            'updatedCover'=>'sometimes|file|mimes:jpg,png,jpeg,gif,svg'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
