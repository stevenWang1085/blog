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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::post('/user/register', 'User\Controller@register');
Route::resource('/user', 'User\Controller');
Route::post('/user/login', 'User\Controller@login');
Route::post('/user/forget_password/send', 'User\Controller@forgetPasswordSendEmail');
Route::post('/user/forget_password/page', 'User\Controller@forgetPasswordPage');
Route::post('/user/forget_password/check', 'User\Controller@forgetPasswordCheck');

Route::resource('/board', 'Board\Controller');
Route::resource('/article', 'Article\Controller');
Route::patch('/article/{id}/favor', 'Article\Controller@updateFavor');
