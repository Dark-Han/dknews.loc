<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\JournalType;

class JournalTypeController extends Controller
{
    public function index()
    {
        $journalType=JournalType::all();
        return response()->json(['data'=>$journalType]);
    }
}
