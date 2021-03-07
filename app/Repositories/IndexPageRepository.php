<?php

namespace App\Repositories;

use App\Models\Category;
use App\Services\CategoryColumnGenerater;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

/**
 * Class IndexPageRepository
 * @package App\Repositories
 */
class IndexPageRepository
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getTopNews()
    {
        $topNewsCountMustBe = 6;
        $topNews = $this->getGeneratedQueryFromDispositionIdArr([2])
            ->limit($topNewsCountMustBe)
            ->get();

        if ($topNewsCountMustBe > count($topNews)) {
            $limit = $topNewsCountMustBe - count($topNews);
            $newsFromOtherDispositions = $this->getGeneratedQueryFromDispositionIdArr([1, 3])
                ->limit($limit)
                ->get();
            $topNews=$topNews->merge($newsFromOtherDispositions);
        }
        return $topNews;
    }

    /**
     * @param $dispositionIds
     * @return \Illuminate\Database\Query\Builder
     */
    private function getGeneratedQueryFromDispositionIdArr($dispositionIds)
    {
        $categorySlugColumn = CategoryColumnGenerater::getSlugColumn();
        $query = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.cover', 'news.title', 'news.seen', 'news.slug', "categories.$categorySlugColumn as categorySlug")
            ->whereIn('news.disposition_id', $dispositionIds)
            ->where('news.language_id', App::getLocale())
            ->orderBy('date_st', 'DESC');
        return $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getNewsFeedSectionNews()
    {
        $categorySlug = CategoryColumnGenerater::getSlugColumn();
        $news = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.cover', 'news.title', 'news.seen', 'news.slug', 'news.date_st', "categories.$categorySlug as categorySlug")
            ->where('news.language_id', App::getLocale())
            ->orderBy('date_st', 'DESC')
            ->limit(20)
            ->get();
        return $news;
    }

    /**
     * @return mixed
     */
    public function getCategoriesWithNews()
    {
        $categoryNameColumn = CategoryColumnGenerater::getNameColumn();
        $categorySlugColumn = CategoryColumnGenerater::getSlugColumn();
        $categories = Category::select('id', "$categoryNameColumn as name", "$categorySlugColumn as slug")
            ->with(
                [
                    'news' => function ($query) {
                        return $query
                            ->select('category_id', 'title', 'cover', 'date_st', 'seen', 'slug')
                            ->where('language_id', App::getLocale())
                            ->limit(4);
                    }
                ]
            )
            ->get();
        return $categories;
    }

}


?>