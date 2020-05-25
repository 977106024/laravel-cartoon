<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//跨域测试
Route::get('/abc', function(Request $request){
    return response()->json(['Hello Laravel with CORS']);
});

Route::get('/register', function(){
    \App\Models\users_tokens::create([
        'name' => '123',
        'email' => '123@123.com',
        'password' => \Illuminate\Support\Facades\Hash::make('123456'),
    ]);
});
