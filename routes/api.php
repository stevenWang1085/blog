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
Route::resource('/user', 'User\Controller');
Route::post('/user/login', 'User\Controller@login');
Route::post('/user/forget_password/send', 'User\Controller@forgetPasswordSendEmail');
Route::post('/user/reset_code/check', 'User\Controller@resetCodeCheck');
Route::get('/user/reset_code_page/check', 'User\Controller@resetCodePageCheck');
Route::post('/user/forget_password/check', 'User\Controller@forgetPasswordCheck');

Route::group(['middleware' => ['check_login:api']], function () {
    Route::post('/user/logout', 'User\Controller@logout');
    Route::get('/user/get_current', 'User\Controller@getCurrentUser');
    Route::resource('/board', 'Board\Controller');
    Route::resource('/article', 'Article\Controller');
    Route::patch('/article/{id}/favor', 'Article\Controller@updateFavor');
    Route::get('/article/{article_id}/comment', 'ArticleComment\Controller@index');
    Route::post('/article/{article_id}/comment', 'ArticleComment\Controller@store');
    Route::patch('/article/{comment_id}/comment', 'ArticleComment\Controller@update');
    Route::delete('/article/{comment_id}/comment', 'ArticleComment\Controller@destroy');


    Route::post('/comment/{comment_id}/reply', 'ArticleCommentReply\Controller@store');
    Route::get('/notification', 'Notification\Controller@index');
});



