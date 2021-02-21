<?php

namespace App\Http\Controllers;

use App\Models\BannerWeb;
use App\Models\Category;
use App\Models\Link;
use App\Models\Newspaper;

class IndexController extends Controller
{
    public function index()
    {
        $languages = ['ru', 'kz', 'en'];
        $firstBanner = BannerWeb::where('serial_number_id', 1)->first();
        $links = Link::with('linkTypes')->get();
        $lastNewsPaper=Newspaper::orderBy('id','desc')->first();
        $categories=Category::all();
        $indexCategories
        return view('index', compact(
            'languages',
            'firstBanner',
                'links',
                'lastNewsPaper',
                'categories'
        )
        );
    }
}