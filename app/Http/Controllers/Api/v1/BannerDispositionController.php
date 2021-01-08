<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BannerDisposition;

class BannerDispositionController extends Controller
{
    public function index()
    {
        $dispositions=BannerDisposition::all();
        return response()->json(['dispositions'=>$dispositions]);
    }
}
