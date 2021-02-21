<?php

use Illuminate\Support\Facades\Route;

Route::get('/','IndexController@index');



//Админка
Route::get('/admin', 'Admin\MainController@index');

Route::get('/admin/{any}', 'Admin\MainController@index')->where('any', '.*');
