<?php

namespace App\Http\Controllers;

use App\Models\BannerWeb;
use App\Models\Category;
use App\Models\Language;
use App\Models\Link;
use App\Models\Newspaper;

class IndexController extends Controller
{
    public function index()
    {

        return view('index');
    }
}