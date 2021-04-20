<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontedController@home')->name('exam.home');
Route::match(['get', 'post'], '/jadwal', 'FrontedController@schedule')->name('exam.schedule');
Route::match(['get', 'post'], '/masuk', 'FrontedController@login')->name('exam.login');
Route::get('/keluar', 'FrontedController@logout')->name('exam.logout');


Route::group(['prefix' => 'admin'], function (){
    Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('exam.admin.login');
    Route::get('/keluar', 'AuthController@logout')->name('exam.admin.logout');
    Route::group(['middleware' => 'auth.exam'], function (){
        Route::get('/', 'BackendController@home')->name('exam.admin.home');
        Route::match(['get', 'post'], '/data/mapel', 'BackendController@subject')->name('exam.admin.data.subject');
        Route::match(['get', 'post'], '/data/tingkat', 'BackendController@level')->name('exam.admin.data.level');
        Route::match(['get', 'post'], '/data/jurusan', 'BackendController@major')->name('exam.admin.data.major');
        Route::match(['get', 'post'], '/data/kelas', 'BackendController@classes')->name('exam.admin.data.class');
        Route::match(['get', 'post'], '/data/akses', 'BackendController@role')->name('exam.admin.data.role');
        Route::match(['get', 'post'], '/peserta', 'BackendController@student')->name('exam.admin.student');
        Route::match(['get', 'post'], '/jadwal', 'BackendController@schedule')->name('exam.admin.schedule');
        Route::match(['get', 'post'], '/jadwal/monitoring/{class_id}/{schedule_id}', 'BackendController@monitoring')->name('exam.admin.schedule.monitoring');
        Route::match(['get', 'post'], '/pengguna', 'BackendController@user')->name('exam.admin.user');
        Route::match(['get', 'post'], '/pengaturan', 'BackendController@setting')->name('exam.admin.setting');
        Route::get('/test', 'BackendController@test')->name('exam.test');
    });
});
