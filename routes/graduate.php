<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', 'FrontedController@home')->name('graduate.home');
Route::match(['get', 'post'], '/autentikasi/{uuid}', 'FrontedController@authentication')->name('graduate.home.authentication');
Route::match(['get', 'post'], '/pengumuman', 'FrontedController@announcement')->name('graduate.announcement');
Route::match(['get', 'post'], '/cetak', 'FrontedController@print')->name('graduate.print');
Route::group(['prefix' => 'admin'], function (){
    Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('graduate.admin.login');
    Route::get('/keluar', 'AuthController@logout')->name('graduate.admin.logout');
    Route::group(['middleware' => 'auth.graduate'], function (){
        Route::match(['get', 'post'], '', 'BackendController@home')->name('graduate.admin.home');
        Route::match(['get', 'post'], '/master/tahun', 'MasterController@year')->name('graduate.admin.master.year');
        Route::match(['get', 'post'], '/master/pelajaran', 'MasterController@subject')->name('graduate.admin.master.subject');
        Route::match(['get', 'post'], '/siswa', 'BackendController@student')->name('graduate.admin.student');
        Route::match(['get', 'post'], '/penilaian/semester', 'ValueController@semester')->name('graduate.admin.value.semester');
        Route::match(['get', 'post'], '/penilaian/ujian', 'ValueController@exam')->name('graduate.admin.value.exam');
        Route::match(['get', 'post'], '/penilaian/ijasah', 'ValueController@certificate')->name('graduate.admin.value.certificate');
        Route::match(['get', 'post'], '/pengumuman', 'BackendController@announcement')->name('graduate.admin.announcement');
        Route::match(['get', 'post'], '/pengaturan', 'BackendController@setting')->name('graduate.admin.setting');
    });
});
