<?php

namespace App\Repositories;

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
        $categorySlug = CategoryColumnGenerater::getSlugColumn();
        $query = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.cover', 'news.title', 'news.seen', 'news.slug', "categories.$categorySlug as categorySlug")
            ->whereIn('news.disposition_id', $dispositionIds)
            ->where('news.language_id', App::getLocale())
            ->orderBy('date_st', 'DESC');
        return $query;
    }

}


?>