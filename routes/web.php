<?php

use Illuminate\Support\Facades\Route;

Route::get('/{locale}', 'IndexController@index');

Route::get('/{locale}/{categorySlug}/{newsSlug}', 'NewsController@index');
//Админка
Route::get('/admin', 'Admin\MainController@index');

Route::get('/admin/{any}', 'Admin\MainController@index')->where('any', '.*');
