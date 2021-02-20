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
        Route::match(['get', 'post'],'/postingan', 'PostController@all')->name('portal.admin.post.all');
        Route::match(['get', 'post'],'/postingan/buat', 'PostController@create')->name('portal.admin.post.create');
        Route::match(['get', 'post'],'/postingan/{id}/ubah', 'PostController@edit')->name('portal.admin.post.edit');
        Route::match(['get', 'post'],'/postingan/kategori', 'PostController@category')->name('portal.admin.post.category');
        Route::match(['get', 'post', 'put', 'delete'],'/halaman/slider', 'PageController@slider')->name('portal.admin.page.slider');
        Route::match(['get', 'post'],'/postingan/tagar', 'PostController@tag')->name('portal.admin.post.tag');
        Route::match(['get', 'post'],'/komentar', 'CommentController@all')->name('portal.admin.comment.all');
        Route::match(['get', 'post'],'/komentar/{id}/lihat', 'CommentController@detail')->name('portal.admin.comment.detail');
        Route::match(['get', 'post'],'/pengguna', 'UserController@all')->name('portal.admin.user');
        Route::match(['get', 'put'],'/pengaturan', 'BackendController@setting')->name('portal.admin.setting');
    });
});

Route::get('/test', 'FrontedController@test');
