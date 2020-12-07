<?php

namespace App\Providers;

use App\Services\Api\NewspaperService;
use Illuminate\Support\ServiceProvider;

use App\Services\Api\CategoryService;
use App\Services\Api\ImageHandlers\SimpleImageHandlerService;

class DependencyInjectionServiceProvider extends ServiceProvider
{

    public $singletons = [
    ];

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
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCategoryService();
        $this->registerNewspaperService();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
