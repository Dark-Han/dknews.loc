<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;

//Админка
Route::get('/admin', 'Admin\MainController@index');

Route::get('/admin/{any}', 'Admin\MainController@index')->where('any', '.*');


//Фронт
Route::middleware([Localization::class])->group(function () {
    Route::get('/last-newspaper','NewspapersController@showLastNewspaper');

    Route::get('/{localization?}', 'IndexController@index');
    Route::get('/{localization}/newspapers-archive', 'NewspapersController@index');
    Route::get('/{localization}/journals/{type}','JournalsController@index');
    Route::get('/{localization}/{categorySlug}','CategoryController@index');
    Route::get('/{localization}/{categorySlug}/{newsSlug}', 'NewsController@index');
});

