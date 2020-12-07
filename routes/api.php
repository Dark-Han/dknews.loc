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
Route::apiResource('v1/news','Api\V1\NewsController');
Route::apiResource('v1/links','Api\V1\LinkController');
Route::apiResource('v1/newspapers','Api\V1\NewspaperController');
