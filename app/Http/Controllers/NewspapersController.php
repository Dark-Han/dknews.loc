<?php

namespace App\Http\Controllers;

use App\Models\Newspaper;

class NewspapersController extends Controller
{
    public function index()
    {
        $newspapers=Newspaper::paginate(18);
        return view('newspapers',compact('newspapers'));
    }
}