<?php

namespace App\Services;

use App\Models\Category;
use App\Services\CategoryColumnGenerater;
use App\Services\CategoryColumnGenerater;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService
{

    private $nameColumn;
    private $slugColumn;

    public function __construct()
    {
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
        $category = Category::select("$this->$nameColumn as name", "$this->slugColumn as slug")
            ->where($this->slugColumn,$slug)
            ->first();
        return $category;
    }

}

?>