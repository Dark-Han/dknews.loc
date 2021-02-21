<?php

namespace App\Http\Requests\V1\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'required|integer',
            'name_ru'=>'required',
            'name_kz'=>'required',
            'name_en'=>'required',
            'serial_number_web'=>'required|integer',
            'serial_number_mob'=>'required|integer',
            'cover'=>'required|string',
            'updatedCover'=>'sometimes|file|mimes:jpg,png,jpeg,gif,svg'
        ];
    }
}
