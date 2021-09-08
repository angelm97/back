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

Route::get('/user', 'App\Http\Controllers\userController@index')->middleware('auth:api');
Route::get('/userau', 'App\Http\Controllers\userController@user')->middleware('auth:api');
Route::post('/user', 'App\Http\Controllers\userController@store'); 
Route::post('/userimage', 'App\Http\Controllers\userController@updateImage'); 

Route::post('/videos', 'App\Http\Controllers\videoController@store'); 
Route::get('/videos', 'App\Http\Controllers\videoController@index');
Route::post('/videos/get', 'App\Http\Controllers\videoController@index'); 
Route::post('/videos/liked', 'App\Http\Controllers\videoController@videoLiked');
Route::post('/videos/viewed', 'App\Http\Controllers\videoController@videoViewed'); 

Route::get('/likes', 'App\Http\Controllers\likeController@index'); 
Route::post('/likes', 'App\Http\Controllers\likeController@store'); 

Route::get('/views', 'App\Http\Controllers\viewController@index'); 
Route::post('/views', 'App\Http\Controllers\viewController@store'); 

