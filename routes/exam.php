<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontedController@home')->name('exam.home');
Route::match(['get', 'post'], '/jadwal', 'FrontedController@schedule')->name('exam.schedule');
Route::match(['get', 'post'], '/masuk', 'FrontedController@login')->name('exam.login');
Route::get('/keluar', 'FrontedController@logout')->name('exam.logout');
Route::get('/test', 'FrontedController@test')->name('exam.test');

Route::group(['prefix' => 'admin'], function (){
    Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('exam.admin.login');
    Route::get('/keluar', 'AuthController@logout')->name('exam.admin.login');
    Route::group(['middleware' => 'auth.exam'], function (){
        Route::get('/', 'BackendController@home')->name('exam.admin.home');
    });
});
