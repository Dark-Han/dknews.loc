<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\CategoryService;
use App\Services\ImageHandlers\SimpleImageHandlerService;

class DependencyInjectionServiceProvider extends ServiceProvider
{   

    public $singletons = [
        // 'CategoryService' => CategoryService::class
    ];
    
    private function registerCategoryService(){
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService(
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
