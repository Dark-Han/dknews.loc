<?php

namespace App\Repositories;

use App\Services\CategoryColumnGenerater;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository
{

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getNewsBySlug($slug)
    {
        $news = $this->getGenerateMainQueryBySlug($slug)
            ->orderBy('date_st', 'DESC')
            ->paginate(10);
        return $news;
    }

    /**
     * @param $slug
     * @return \Illuminate\Support\Collection
     */
    public function getTopNewsBySlug($slug){
        $news=$this->getGenerateMainQueryBySlug($slug)
            ->orderBy('seen','DESC')
            ->limit(10)
            ->get();
        return $news;
    }

    /**
     * @param $slug
     * @return \Illuminate\Database\Query\Builder
     */
    private function getGenerateMainQueryBySlug($slug){
        $categorySlugColumn = CategoryColumnGenerater::getSlugColumn();
        $categoryNewsMainQuery=DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->join('languages', 'news.language_id', '=', 'languages.id')
            ->select(
                'news.cover'
                , 'news.title'
                , 'news.seen'
                , 'news.slug'
                ,'news.date_st'
                , "categories.$categorySlugColumn as categorySlug"
            )
            ->where("categories.$categorySlugColumn", $slug)
            ->where('languages.name',App::getLocale());
        return $categoryNewsMainQuery;
    }
}

?>