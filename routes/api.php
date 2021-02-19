<?php

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

Route::middleware(['auth:api'])->name('api.')->group(function() {

    // AUTHENTICATION
    Route::group(['prefix' => 'auth', 'name' => 'auth.'], function () {
        Route::post('register', 'API\AuthApiController@register')->name('register')->withoutMiddleware(['auth:api']);
        Route::post('login', 'API\AuthApiController@login')->name('login')->withoutMiddleware(['auth:api']);

        Route::get('logout', 'API\AuthApiController@logout')->name('logout');
        Route::get('user', 'API\AuthApiController@user')->name('user');
    });
});
