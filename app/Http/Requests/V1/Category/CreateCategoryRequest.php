<?php

namespace App\Http\Requests\V1\Category;

use App\Rules\CoverRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateCategoryRequest extends FormRequest
{
    public function rules(Request $request)
    {
        return [
            'name_ru'=>'required',
            'name_kz'=>'required',
            'name_en'=>'required',
            'serial_number_web'=>'required|integer',
            'serial_number_mob'=>'required|integer',
            'cover'=>'required|file|mimes:jpg,png,jpeg,gif,svg'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
