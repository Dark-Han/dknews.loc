<?php

namespace App\Http\View\Composers;

use App\Models\BannerWeb;
use App\Models\Language;
use App\Models\Link;
use App\Models\Newspaper;
use App\Services\CategoryService;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class LayoutComposer
{
    private $categoryService;

    public function __construct()
    {
        $this->categoryService=new CategoryService();
    }

    public function compose(View $view)
    {
        $languages = Language::orderBy('serial_number','ASC')->get();
        $firstBanner = BannerWeb::where('serial_number_id', 1)->first();
        $links = Link::with('linkTypes')->get();
        $categories=$this->categoryService->getHeaderCategories();

        $view->with('locale',App::getLocale());
        $view->with('languages', $languages);
        $view->with('firstBanner', $firstBanner);
        $view->with('links', $links);
        $view->with('headerCategories', $categories);
    }
}