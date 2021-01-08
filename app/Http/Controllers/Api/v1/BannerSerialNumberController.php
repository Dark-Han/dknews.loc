<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BannerSerialNumber;

class BannerSerialNumberController extends Controller
{
    public function index()
    {
        $serialNumbers=BannerSerialNumber::all();
        return response()->json(['serialNumbers'=>$serialNumbers]);
    }
}
