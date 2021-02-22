<?php

namespace App\Http\View\Composers;

use App\Models\BannerWeb;
use App\Models\Category;
use App\Models\Language;
use App\Models\Link;
use App\Models\Newspaper;
use Illuminate\View\View;

class LayoutComposer
{
    public function compose(View $view)
    {
        $languages = Language::all();
        $firstBanner = BannerWeb::where('serial_number_id', 1)->first();
        $links = Link::with('linkTypes')->get();
        $lastNewsPaper=Newspaper::orderBy('id','desc')->first();
        $categories=Category::all();

        $view->with('languages', $languages);
        $view->with('firstBanner', $firstBanner);
        $view->with('links', $links);
        $view->with('lastNewsPaper', $lastNewsPaper);
        $view->with('headerCategories', $categories);
    }
}