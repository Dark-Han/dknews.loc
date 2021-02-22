<?php

namespace App\Providers;

use App\Http\View\Composers\LayoutComposer;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Date::setlocale(config('app.locale'));
        View::composer('layout', LayoutComposer::class);
    }
}
