<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Language;

class LanguageController extends Controller
{
    public function index()
    {
        $languages=Language::all();
        return response()->json($languages);
    }
}