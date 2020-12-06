<?php

namespace App\Http\Requests\V1\Link;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id'=>'required|integer',
            'link'=>'required|string',
            'link_type_id'=>'required|integer'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
