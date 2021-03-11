<?php

namespace App\Http\Controllers;

use App\Models\Journal;
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
        $infographicsNews=$indexPageRepository->getInfographicsNews();
        $mediaPartners=$indexPageRepository->getMediaPartners();
        $silkAndRoadNews=$indexPageRepository->getSilkRoadNews();
        $silkAndRoadJournal=Journal::where('journal_type_id',1)->orderBy('id','DESC')->first();
        $beltAndRoadJournal=Journal::where('journal_type_id',2)->orderBy('id','DESC')->first();
        return view('index',compact(
            'topNews'
            ,'newsFeedSectionNews'
            ,'categories'
                , 'specificCategories'
                , 'mediaCategories'
                ,'infographicsNews'
                ,'mediaPartners'
                ,'silkAndRoadNews'
                ,'silkAndRoadJournal'
                ,'beltAndRoadJournal'
            )
        );
    }
}