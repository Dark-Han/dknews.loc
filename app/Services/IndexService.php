<?php

namespace App\Services;

use App\Models\News;

class IndexService{

    private $topNewsCountMustBe=6;

    public function getTopNews(){
        $topNews=News::where('disposition_id',2)->orderBy('date_st','DESC')->limit(5)->get();
        if($this->topNewsCountSmallThanMustBe($topNews)){
            return $this->getTopNewsWithMissingsFromOtherDispositions($topNews);
        }
    }

    private function topNewsCountSmallThanMustBe($topNews){
        if($this->topNewsCountMustBe>count($topNews)){
            return true;
        }
        return false;
    }

    private function getTopNewsWithMissingsFromOtherDispositions($topNews){
        $limit=$this->topNewsCountMustBe-count($topNews);
        $news=News::whereIn('disposition_id',[1,3])->orderBy('date_st','DESC')->limit($limit)->get();
        $topNews=$topNews->merge($news);
        return $topNews;
    }

    public function getNewsFeedSectionNews(){
        $news=News::orderBy('date_st','DESC')->limit(20)->get();
        return $news;
    }

}

?>