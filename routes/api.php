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

    // Role
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', 'API\RoleApiController@index')->name('index');
        Route::get('/paginate', 'API\RoleApiController@paginate')->name('paginate');
        Route::get('/{role_id}/permissions', 'API\RoleApiController@permissionsByRole')->name('permissions-by-role');
        Route::post('/store', 'API\RoleApiController@store')->name('store');
        Route::put('/{role_id}/update', 'API\RoleApiController@update')->name('update');
        Route::delete('/{role_id}/destroy', 'API\RoleApiController@destroy')->name('destroy');
    });

    // VOUCHER
    Route::prefix('vouchers')->name('vouchers.')->group(function () {
        Route::get('/', 'API\VoucherApiController@index')->name('index');
    });
});
