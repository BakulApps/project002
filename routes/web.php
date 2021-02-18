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

Route::get('/', 'FrontedController@home')->name('potral.home');
Route::get('/artikel', 'FrontedController@article')->name('potral.article');
Route::match(['get', 'post'],'/artikel/{id}/lihat', 'FrontedController@article_read')->name('potral.article.read');
Route::get('/artikel/kategori/{id}', 'FrontedController@category')->name('portal.category');
Route::get('/acara/{id}', 'FrontedController@event')->name('potral.event');

Route::group(['prefix' => 'administrator'], function (){
    Route::match(['get', 'post'],'/masuk', 'AuthController@login')->name('portal.admin.login');
    Route::get('/keluar', 'AuthController@logout')->name('portal.admin.logout');
    Route::group(['middleware' => 'auth.portal'], function (){
        Route::get('/', 'BackendController@home')->name('portal.admin.home');
        Route::match(['get', 'post'],'/artikel', 'ArticleController@all')->name('portal.admin.article.all');
        Route::match(['get', 'post'],'/artikel/buat', 'ArticleController@create')->name('portal.admin.article.create');
        Route::match(['get', 'post'],'/artikel/{id}/ubah', 'ArticleController@edit')->name('portal.admin.article.edit');
        Route::match(['get', 'post'],'/artikel/kategori', 'ArticleController@category')->name('portal.admin.article.category');
        Route::match(['get', 'post'],'/artikel/tagar', 'ArticleController@tag')->name('portal.admin.article.tag');



        Route::get('/pengaturan', 'BackendController@setting')->name('portal.admin.setting');
    });
});

Route::get('/test', 'FrontedController@test');
