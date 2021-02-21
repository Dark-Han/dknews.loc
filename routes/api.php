<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('v1/categories','Api\V1\CategoryController');

Route::put('v1/news/image','Api\V1\NewsController@uploadImage');
Route::delete('v1/news/image','Api\V1\NewsController@deleteImage');
Route::apiResource('v1/news','Api\V1\NewsController');

Route::apiResource('v1/links','Api\V1\LinkController');
Route::apiResource('v1/newspapers','Api\V1\NewspaperController');
Route::get('v1/dispositions','Api\V1\DispositionController@index');
Route::get('v1/limits','Api\V1\LimitController@index');
Route::get('v1/languages','Api\V1\LanguageController@index');
Route::apiResource('v1/journals','Api\V1\JournalController');
Route::get('v1/journal_types','Api\V1\JournalTypeController@index');
Route::apiResource('v1/banners_web','Api\V1\BannerWebController');
Route::apiResource('v1/medias','Api\V1\MediaController');

Route::namespace('Api\V1')->prefix('v1/banners')->group(function () {
    Route::get('dispositions', 'BannerDispositionController@index');
    Route::get('limits', 'BannerLimitController@index');
    Route::get('serial_numbers', 'BannerSerialNumberController@index');
});
