<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class IndexService{

    private $topNewsCountMustBe=6;

    public function getTopNews(){
        $categorySlug=LocalizationService::getCategorySlugColumn();
        $topNews=DB::table('news')
            ->join('categories','news.category_id','=','categories.id')
            ->join('languages','news.language_id','=','languages.id')
            ->select('news.cover','news.title','news.seen','news.slug',"categories.$categorySlug as categorySlug")
            ->where('news.disposition_id',2)
            ->where('languages.name',App::getLocale())
            ->orderBy('date_st','DESC')
            ->limit($this->topNewsCountMustBe)
            ->get();

        if($this->topNewsCountSmallThanMustBe($topNews)){
            return $this->getTopNewsWithMissingsFromOtherDispositions($topNews);
        }
        return $topNews;
    }

    private function topNewsCountSmallThanMustBe($topNews){
        if($this->topNewsCountMustBe>count($topNews)){
            return true;
        }
        return false;
    }

    private function getTopNewsWithMissingsFromOtherDispositions($topNews){
        $categorySlug=LocalizationService::getCategorySlugColumn();
        $limit=$this->topNewsCountMustBe-count($topNews);
        $news=DB::table('news')
            ->join('categories','news.category_id','=','categories.id')
            ->join('languages','news.language_id','=','languages.id')
            ->select('news.cover','news.title','news.seen','news.slug',"categories.$categorySlug as categorySlug")
            ->whereIn('news.disposition_id',[1,3])
            ->where('languages.name',App::getLocale())
            ->orderBy('date_st','DESC')
            ->limit($limit)
            ->get();
        $topNews=$topNews->merge($news);
        return $topNews;
    }

    public function getNewsFeedSectionNews(){
        $categorySlug=LocalizationService::getCategorySlugColumn();
        $news=DB::table('news')
            ->join('categories','news.category_id','=','categories.id')
            ->join('languages','news.language_id','=','languages.id')
            ->select('news.cover','news.title','news.seen','news.slug','news.date_st',"categories.$categorySlug as categorySlug")
            ->where('languages.name',App::getLocale())
            ->orderBy('date_st','DESC')
            ->limit(20)
            ->get();
        return $news;
    }

}

?>