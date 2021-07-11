<?php

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

Route::group(['middleware' => 'check_login:web'], function () {
    Route::get('/forum', function () {
        return view('forum');
    });
    Route::get('/notify', function () {
        return view('notify');
    });
});

Route::get('/', function () {
    return view('login');
})->middleware('check_login:login');


Route::get('/reset_password/{code}', function ($code) {
    return view('reset_password_check');
});


