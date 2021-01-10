<?php

namespace App\Providers;

use App\Services\Api\MediaService;
use App\Services\Api\NewspaperService;
use Illuminate\Support\ServiceProvider;

use App\Services\Api\CategoryService;
use App\Services\Api\NewsService;
use App\Services\Api\JournalService;
use App\Services\Api\BannerWebService;

use App\Services\Api\ImageHandlers\SimpleImageHandlerService;

class DependencyInjectionServiceProvider extends ServiceProvider
{

    public $singletons = [
    ];

    public function register()
    {
        $this->registerCategoryService();
        $this->registerNewspaperService();
        $this->registerNewsService();
        $this->registerJournalService();
        $this->registerBannerWebService();
        $this->registerMediaService();
    }

    private function registerCategoryService(){
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService(
                new SimpleImageHandlerService()
            );
        });
    }

    private function registerNewspaperService(){
        $this->app->singleton(NewspaperService::class, function ($app) {
            return new NewspaperService(
                new SimpleImageHandlerService()
            );
        });
    }

    private function registerNewsService(){
        $this->app->singleton(NewsService::class, function ($app) {
            return new NewsService(
                new SimpleImageHandlerService()
            );
        });
    }

    private function registerJournalService(){
        $this->app->singleton(JournalService::class, function ($app) {
            return new JournalService(
                new SimpleImageHandlerService()
            );
        });
    }

    private function registerBannerWebService(){
        $this->app->singleton(BannerWebService::class, function ($app) {
            return new BannerWebService(
                new SimpleImageHandlerService()
            );
        });
    }

    private function registerMediaService(){
        $this->app->singleton(MediaService::class, function ($app) {
            return new MediaService(
                new SimpleImageHandlerService()
            );
        });
    }

    public function boot()
    {
        //
    }
}
