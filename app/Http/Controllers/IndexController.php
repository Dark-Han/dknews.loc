<?php

namespace App\Http\Controllers;

use App\Services\IndexService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    public function index(Request $request,IndexService $indexService)
    {
        $topNews=$indexService->getTopNews();
        $newsFeedSectionNews=$indexService->getNewsFeedSectionNews();
        return view('index',compact('topNews','newsFeedSectionNews'));
    }
}