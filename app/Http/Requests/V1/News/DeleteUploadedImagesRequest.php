<?php

namespace App\Http\Requests\V1\News;

use Illuminate\Foundation\Http\FormRequest;

class DeleteUploadedImagesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'uploadedImages'=>'required|array',
            'uploadedImages.*.path'=>'required|string'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
