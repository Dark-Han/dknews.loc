<?php

namespace App\Http\Controllers;

use App\Repositories\IndexPageRepository;
use App\Services\IndexService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request,IndexPageRepository $indexPageRepository)
    {
        $topNews=$indexPageRepository->getTopNews();
        $newsFeedSectionNews=$indexPageRepository->getNewsFeedSectionNews();
        $categories = $indexPageRepository->getTopCategoriesWithNews();
        $specificCategories = $indexPageRepository->getSpecificCategoriesWithNews();
        $mediaCategories = $indexPageRepository->getMediaCategoriesWithNews();
//        $infographicsNews=$news->

        return view('index',compact(
            'topNews'
            ,'newsFeedSectionNews'
            ,'categories'
                , 'specificCategories'
                , 'mediaCategories'
            )
        );
    }
}