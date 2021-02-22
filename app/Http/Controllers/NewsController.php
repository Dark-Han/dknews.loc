<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Services\CategoryService;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request,CategoryService $categoryService)
    {
        App::setLocale($request->locale);
        $news=News::where('slug',$request->newsSlug)->first();
        $category=$categoryService->getCategoryBySlug($request->categorySlug);
        return view('news',compact(
            'news',
            'category'
        ));
    }
}