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

Route::get('/', 'FrontedController@home')->name('portal.home');
Route::get('/artikel', 'FrontedController@article')->name('portal.article');
Route::match(['get', 'post'],'/artikel/{id}/lihat', 'FrontedController@article_read')->name('portal.article.read');
Route::get('/artikel/kategori/{id}', 'FrontedController@category')->name('portal.category');
Route::get('/acara', 'FrontedController@event')->name('portal.event');
Route::get('/acara/{id}/baca', 'FrontedController@event_read')->name('portal.event.read');
Route::get('/guru', 'FrontedController@teacher')->name('portal.teacher');
Route::get('/guru/{id}/lihat', 'FrontedController@teacher_detail')->name('portal.teacher.read');
Route::get('/ekstrakurikuler', 'FrontedController@extracurricular')->name('portal.extracurricular');
Route::get('/ekstrakurikuler/{id}/lihat', 'FrontedController@extracurricular_detail')->name('portal.extracurricular.read');

Route::group(['prefix' => 'administrator'], function (){
    Route::match(['get', 'post'],'/masuk', 'AuthController@login')->name('portal.admin.login');
    Route::get('/keluar', 'AuthController@logout')->name('portal.admin.logout');
    Route::group(['middleware' => 'auth.portal'], function (){
        Route::get('/', 'BackendController@home')->name('portal.admin.home');
        Route::match(['get', 'post'],'/postingan', 'PostController@all')->name('portal.admin.post.all');
        Route::match(['get', 'post'],'/postingan/buat', 'PostController@create')->name('portal.admin.post.create');
        Route::match(['get', 'post'],'/postingan/{id}/ubah', 'PostController@edit')->name('portal.admin.post.edit');
        Route::match(['get', 'post'],'/postingan/kategori', 'PostController@category')->name('portal.admin.post.category');
        Route::match(['get', 'post'],'/postingan/tagar', 'PostController@tag')->name('portal.admin.post.tag');
        Route::match(['get', 'post'],'/halaman/beranda', 'PageController@home')->name('portal.admin.page.home');
        Route::match(['get', 'post'],'/halaman/artikel', 'PostController@post')->name('portal.admin.page.post');
        Route::match(['get', 'post'],'/kegiatan', 'EventController@all')->name('portal.admin.event.all');
        Route::match(['get', 'post'],'/kegiatan/buat', 'EventController@create')->name('portal.admin.event.create');
        Route::match(['get', 'post'],'/kegiatan/{id}/ubah', 'EventController@edit')->name('portal.admin.event.edit');
        Route::match(['get', 'post'],'/widget/slider', 'WidgetController@slider')->name('portal.admin.widget.slider');
        Route::match(['get', 'post'],'/widget/program', 'WidgetController@program')->name('portal.admin.widget.program');
        Route::match(['get', 'post'],'/widget/ekstrakurikuler', 'WidgetController@extracurricular')->name('portal.admin.widget.extracurricular');
        Route::match(['get', 'post'],'/widget/guru', 'WidgetController@teacher')->name('portal.admin.widget.teacher');
        Route::match(['get', 'post'],'/widget/fasilitas', 'WidgetController@facility')->name('portal.admin.widget.facility');
        Route::match(['get', 'post'],'/widget/testimoni', 'WidgetController@testimonial')->name('portal.admin.widget.testimonial');
        Route::match(['get', 'post'],'/komentar', 'CommentController@all')->name('portal.admin.comment.all');
        Route::match(['get', 'post'],'/komentar/{id}/lihat', 'CommentController@detail')->name('portal.admin.comment.detail');
        Route::match(['get', 'post'], '/mainmenu', 'BackendController@mainmenu')->name('portal.admin.mainmenu');
        Route::match(['get', 'post'],'/pengguna', 'BackendController@user')->name('portal.admin.user');
        Route::match(['get', 'post'],'/pengaturan', 'BackendController@setting')->name('portal.admin.setting');
    });
});
