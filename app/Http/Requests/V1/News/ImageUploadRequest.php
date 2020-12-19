<?php

namespace App\Http\Requests\V1\News;

use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file'=>'required|file|mimes:jpg,png,jpeg,gif,svg'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
