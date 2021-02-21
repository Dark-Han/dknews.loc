<?php

namespace App\Http\Requests\V1\News;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'=>'required|string',
            'text'=>'required|string',
            'category_id'=>'required|integer',
            'cover'=>'required|string',
            'language_id'=>'required|integer',
            'disposition_id'=>'required|integer',
            'forever'=>'required|boolean',
            'limit_id'=>'required|integer',
            'timestampSt.date'=>'required|date_format:Y-m-d',
            'timestampSt.time'=>'required|date_format:H:i',
            'timestampEn.date'=>'required|date_format:Y-m-d',
            'timestampEn.time'=>'required|date_format:H:i',
            'uploadedImages'=>'required|array',
            'uploadedImages.*.path'=>'required|string',
            'seen'=>'required|integer',
            'must_seen'=>'required|integer'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
