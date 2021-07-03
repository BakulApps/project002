<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', 'FrontedController@home')->name('student.home');
Route::match(['get', 'post'], '/data', 'FrontedController@data')->name('student.data');
Route::match(['get', 'post'], '/profil', 'FrontedController@profile')->name('student.profile');
Route::match(['get', 'post'], '/akademik/jadwal', 'FrontedController@schedule')->name('student.academic.schedule');
Route::match(['get', 'post'], '/akademik/kehadiran', 'FrontedController@presence')->name('student.academic.presence');
Route::match(['get', 'post'], '/akademik/raport', 'FrontedController@report')->name('student.academic.report');
Route::match(['get', 'post'], '/keuangan/tagihan', 'FrontedController@invoice')->name('student.finance.invoice');
Route::match(['get', 'post'], '/keuangan/pembayaran', 'FrontedController@payment')->name('student.finance.payment');
Route::match(['get', 'post'], '/masuk', 'FrontedController@login')->name('student.login');
Route::match(['get', 'post'], '/keluar', 'FrontedController@logout')->name('student.logout');
Route::group(['prefix' => 'administrator'], function (){
    Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('student.backend.login');
    Route::match(['get', 'post'], '/keluar', 'AuthController@logout')->name('student.backend.logout');
    Route::group(['middleware' => 'auth.student'], function (){
        Route::match(['get', 'post'], '/', 'BackendController@home')->name('student.backend.home');
        Route::match(['get', 'post'], '/master/tahun', 'MasterController@year')->name('student.backend.master.year');
        Route::match(['get', 'post'], '/master/jurusan', 'MasterController@major')->name('student.backend.master.major');
        Route::match(['get', 'post'], '/master/kelas', 'MasterController@classes')->name('student.backend.master.classes');
        Route::match(['get', 'post'], '/master/sekolah', 'MasterController@school')->name('student.backend.master.school');
        Route::match(['get', 'post'], '/siswa/semua', 'BackendController@student')->name('student.backend.student.all');
        Route::match(['get', 'post'], '/siswa/{id}/detail', 'BackendController@detail')->name('student.backend.student.detail');
        Route::match(['get', 'post'], 'pengaturan', 'BackendController@setting')->name('student.backend.setting');
    });
});
Route::get('/test', 'FrontedController@test');
