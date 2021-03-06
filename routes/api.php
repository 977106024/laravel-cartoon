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

Route::middleware('auth:a')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth'], function(){
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

   
});


Route::group(['middleware' => 'auth:a'], function() {
     //上传图片
     Route::post('/upload', 'cartoon@upload');

     //人像动漫化
     Route::post('/getCartoon', 'cartoon@getCartoon');
});

