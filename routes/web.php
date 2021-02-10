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
    //dd('pase');
    dd(auth()->check() ? 'true' : 'false');
    return redirect('dashboard');
})->name('web.basepath');


Route::get('/{optional?}', function ($optional) {

    //dd(auth()->check() ? 'true' : 'false');
    if($optional === 'login' && auth()->check()){
        return redirect('dashboard');
    }else if($optional !== 'login' && !auth()->check()){
        return redirect('login');
    }

    return view('app');
})->where('optional', '.*');
