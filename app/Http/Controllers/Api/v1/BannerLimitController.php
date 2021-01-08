<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BannerLimit;

class BannerLimitController extends Controller
{
    public function index()
    {
        $limits=BannerLimit::all();
        return response()->json(['limits'=>$limits]);
    }
}
