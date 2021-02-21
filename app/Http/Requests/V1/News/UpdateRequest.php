<?php

namespace App\Http\Requests\V1\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'=>'required|string',
            'text'=>'required|string',
            'category_id'=>'required|integer',
            'cover'=>'required|string',
            'disposition_id'=>'required|integer',
            'language_id'=>'required|integer',
            'forever'=>'required|boolean',
            'limit_id'=>'required|integer',
            'timestampSt.date'=>'required|date_format:Y-m-d',
            'timestampSt.time'=>'required|date_format:H:i',
            'timestampEn.date'=>'required|date_format:Y-m-d',
            'timestampEn.time'=>'required|date_format:H:i',
            'uploadedImages'=>'present|array',
            'uploadedImages.*.path'=>'sometimes|required|string',
            'seen'=>'required|integer',
            'must_seen'=>'required|integer'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
