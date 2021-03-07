<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Repositories\IndexPageRepository;
class IndexService{

    private $indexPageRepository;

    public function __construct()
    {
        $this->indexPageRepository=new IndexPageRepository();
    }

    public function getTopNews(){
        $topNews=$this->indexPageRepository->getTopNews();
        return $topNews;
    }

    public function getNewsFeedSectionNews(){
        $categorySlug=CategoryColumnGenerater::getSlugColumn();
        $news=DB::table('news')
            ->join('categories','news.category_id','=','categories.id')
            ->select('news.cover','news.title','news.seen','news.slug','news.date_st',"categories.$categorySlug as categorySlug")
            ->where('news.language_id',App::getLocale())
            ->orderBy('date_st','DESC')
            ->limit(20)
            ->get();
        return $news;
    }

}

?>