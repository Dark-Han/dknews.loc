<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Limit;

class LimitController extends Controller
{
    public function index()
    {
        $data['limits']=Limit::all();
        return response()->json($data);
    }
}
