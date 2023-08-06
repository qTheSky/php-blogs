<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::middleware('auth:api')->group(function () {
    Route::post('blogs', 'App\Http\Controllers\BlogController@create');
    Route::delete('blogs/{blog}', 'App\Http\Controllers\BlogController@destroy')->middleware('can:delete,blog');
});
Route::get('blogs', 'App\Http\Controllers\BlogController@index');

Route::middleware('auth:api')->group(function () {
    Route::post('blogs/{blog}/posts', 'App\Http\Controllers\PostController@create');
    Route::delete('blogs/{blog}/posts/{post}', 'App\Http\Controllers\PostController@destroy');
});
