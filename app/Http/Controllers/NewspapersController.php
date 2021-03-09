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

    public function showLastNewspaper()
    {
        $newspaper = Newspaper::orderBy('id', 'DESC')->first();
        return response()->file(
            storage_path("app/public/$newspaper->newspaper")
            , [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'filename="'.$newspaper->name.'.pdf"'
            ]
        );
    }
}