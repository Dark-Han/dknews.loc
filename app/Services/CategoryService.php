<?php

namespace App\Services;

use App\Models\Category;
use App\Services\LocaleService;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getHeaderCategories()
    {
        $nameColumn = LocaleService::getCategoryNameColumn();
        $slugColumn = LocaleService::getCategorySlugColumn();
        $category = Category::select("$nameColumn as name", "$slugColumn as slug")
            ->orderBy('serial_number_web', 'DESC')
            ->get();
        return $category;
    }


    /**
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getCategoryBySlug($slug){
        $nameColumn = LocaleService::getCategoryNameColumn();
        $slugColumn = LocaleService::getCategorySlugColumn();
        $category = Category::select("$nameColumn as name", "$slugColumn as slug")
            ->where($slugColumn,$slug)
            ->first();
        return $category;
    }

}

?>