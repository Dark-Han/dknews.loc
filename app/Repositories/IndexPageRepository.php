<?php

namespace App\Repositories;

use App\DTO\CategoriesWithNewsParams;
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
     * @var
     */
    private $categoriesWithNewsCollection;

    /**
     * IndexPageRepository constructor.
     */
    public function __construct()
    {
        $this->setCategoriesWithNewsCollection();
    }

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
    public function getTopCategoriesWithNews()
    {
        $params=new CategoriesWithNewsParams([],8,4);
        $categories = $this->getCategoriesWithNewsFromParams($params);
        return $categories;
    }

    /**
     * @return mixed
     */
    public function getSpecificCategoriesWithNews()
    {
        $params=new CategoriesWithNewsParams([1,3],false,5);
        $categories = $this->getCategoriesWithNewsFromParams($params);
        return $categories;
    }

    /**
     * @return mixed
     */
    public function getMediaCategoriesWithNews()
    {
        $params=new CategoriesWithNewsParams([1,2,3],false,3);
        $categories = $this->getCategoriesWithNewsFromParams($params);
        return $categories;
    }

    /**
     * @param CategoriesWithNewsParams $params
     * @return mixed
     */
    //Вынести в будущем в отдельный сервис
    public function getCategoriesWithNewsFromParams(CategoriesWithNewsParams $params)
    {
        $categories = $this->categoriesWithNewsCollection;

        if (!empty($params->getCategoriesIds())) {
            $categories = $categories->whereIn('id', $params->getCategoriesIds());
        }
        if ($params->getCategoriesLimit()) {
            $categories = $categories->take($params->getCategoriesLimit());
        }
        if ($params->getNewsLimit()) {
            $limit = $params->getNewsLimit();
            $categories = $categories->map(function ($category, $i) use ($limit) {
                return $this->getLimitedNewsOf($category, $limit);
            });
        }

        return $categories;
    }

    /**
     * @param $category
     * @param $limit
     * @return mixed
     */
    private function getLimitedNewsOf($category, $limit)
    {
        $filteredNews = $category->news->filter(function ($news, $j) use ($limit) {
            return $j < $limit;
        });
        $category->setRelation('news', $filteredNews);
        return $category;
    }

    /**
     *
     */
    private function setCategoriesWithNewsCollection()
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
                            ->limit(5);
                    }
                ]
            )
            ->orderBy('serial_number_web', 'ASC')->get();
        $this->categoriesWithNewsCollection = $categories;
    }
}


?>