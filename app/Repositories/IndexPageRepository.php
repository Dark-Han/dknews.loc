<?php

namespace App\Repositories;

use App\DTO\CategoriesWithNewsParamsDTO;
use App\Models\Category;
use App\Models\Media;
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
        $params=new CategoriesWithNewsParamsDTO([],8,4);
        $categories = $this->getCategoriesWithNewsFromParams($params);
        return $categories;
    }

    /**
     * @return mixed
     */
    public function getSpecificCategoriesWithNews()
    {
        $params=new CategoriesWithNewsParamsDTO([1,3],false,5);
        $categories = $this->getCategoriesWithNewsFromParams($params);
        return $categories;
    }

    /**
     * @return mixed
     */
    public function getMediaCategoriesWithNews()
    {
        $params=new CategoriesWithNewsParamsDTO([1,2,3],false,3);
        $categories = $this->getCategoriesWithNewsFromParams($params);
        return $categories;
    }

    /**
     * @return mixed
     */
    public function getInfographicsNews()
    {
        $params=new CategoriesWithNewsParamsDTO([1],1,3);
        $categories = $this->getCategoriesWithNewsFromParams($params);
        return $categories;
    }

    /**
     * @return mixed
     */
    public function getSilkRoadNews(){
        $params=new CategoriesWithNewsParamsDTO([1],1,4);
        $categories = $this->getCategoriesWithNewsFromParams($params);
        return $categories;
    }
    /**
     * @param CategoriesWithNewsParamsDTO $params
     * @return mixed
     */
    //Вынести в будущем в отдельный сервис
    /**
     * @param CategoriesWithNewsParamsDTO $params
     * @return mixed
     */
    public function getCategoriesWithNewsFromParams(CategoriesWithNewsParamsDTO $params)
    {
        $categories = $this->categoriesWithNewsCollection;
        $categoriesIds=$params->getCategoriesIds();
        $categoriesLimit=$params->getCategoriesLimit();
        $newsLimit=$params->getNewsLimit();

        if (!empty($categoriesIds)) {
            $categories = $categories->whereIn('id', $categoriesIds);
        }
        if ($categoriesLimit) {
            $categories = $categories->take($categoriesLimit);
        }
        if ($newsLimit) {
            $categories = $categories->map(function ($category, $i) use ($newsLimit) {
                return $this->getLimitedNewsOf($category, $newsLimit);
            });
        }

        if($categoriesLimit===1){
            return $categories->first();
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
     * @return Media[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getMediaPartners(){
        $mediaPartners=Media::all()->groupBy('size_id');
//        dd($mediaPartners);
        return $mediaPartners;
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