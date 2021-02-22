<?php

namespace App\Http\Controllers;

use App\Models\BannerWeb;
use App\Models\Category;
use App\Models\Language;
use App\Models\Link;
use App\Models\Newspaper;
use App\Services\IndexService;

class IndexController extends Controller
{
    public function index(IndexService $indexService)
    {
        $topNews=$indexService->getTopNews();
        $newsFeedSectionNews=$indexService->getNewsFeedSectionNews();
        return view('index',compact('topNews','newsFeedSectionNews'));
    }
}