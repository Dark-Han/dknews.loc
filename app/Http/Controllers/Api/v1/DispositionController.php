<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Disposition;

class DispositionController extends Controller
{
    public function index()
    {
        $data['dispositions']=Disposition::all();
        return response()->json($data);
    }
}
