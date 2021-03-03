<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, CategoryService $categoryService)
    {
        $category = $categoryService->getCategoryBySlug($request->categorySlug);
        $categoryNews = $categoryService->getNewsBySlug($request->categorySlug);
        $categoryTopNews=$categoryService->getTopNewsBySlug($request->categorySlug);
        return view('category', compact(
            'categoryNews'
            , 'category'
            ,'categoryTopNews'
        ));
    }
}