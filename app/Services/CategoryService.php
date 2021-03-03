<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryColumnGenerater;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService
{

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var string
     */
    private $nameColumn;
    /**
     * @var string
     */
    private $slugColumn;

    /**
     * CategoryService constructor.
     */
    public function __construct()
    {
        $this->categoryRepository=new CategoryRepository();
        $this->nameColumn = CategoryColumnGenerater::getNameColumn();
        $this->slugColumn = CategoryColumnGenerater::getSlugColumn();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getHeaderCategories()
    {
        $category = Category::select("$this->nameColumn as name", "$this->slugColumn as slug")
            ->orderBy('serial_number_web', 'DESC')
            ->get();
        return $category;
    }


    /**
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getCategoryBySlug($slug){
        $category = Category::select("$this->nameColumn as name", "$this->slugColumn as slug")
            ->where($this->slugColumn,$slug)
            ->first();
        return $category;
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getNewsBySlug($slug){
        $news=$this->categoryRepository->getNewsBySlug($slug);
        return $news;
    }

    /**
     * @param $slug
     * @return \Illuminate\Support\Collection
     */
    public function getTopNewsBySlug($slug){
        $news=$this->categoryRepository->getTopNewsBySlug($slug);
        return $news;
    }

}

?>