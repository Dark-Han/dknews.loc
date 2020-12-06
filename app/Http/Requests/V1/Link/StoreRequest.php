<?php

namespace App\Http\Requests\V1\Link;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'link'=>'required|string',
            'link_type_id'=>'required|integer'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
