<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'FrontedController@home')->name('admission.home');
Route::get('/autentikasi/{uuid}', 'FrontedController@authenticate')->name('admission.authenticate');
Route::get('/informasi', 'FrontedController@term')->name('admission.term');
Route::match(['get', 'post'],'/pendaftaran', 'FrontedController@register')->name('admission.register');
Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('admission.login');
Route::get('/keluar', 'AuthController@logout')->name('admission.logout');
Route::match(['get', 'post'],'/rekap', 'FrontedController@result')->name('admission.result');
Route::match(['get', 'post'], '/pendaftar', 'FrontedController@registrant')->name('admission.registrant');

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admission'], function (){
    Route::get('/', 'BackendController@home')->name('admission.admin.home');
    Route::match(['get', 'post'],'/master/sekolah', 'MasterController@school')->name('admission.admin.master.school');
    Route::match(['get', 'post'],'/master/agama', 'MasterController@religion')->name('admission.admin.master.religion');
    Route::match(['get', 'post'],'/master/hobi', 'MasterController@hobby')->name('admission.admin.master.hobby');
    Route::match(['get', 'post'],'/master/cita', 'MasterController@future')->name('admission.admin.master.future');
    Route::match(['get', 'post'],'/siswa', 'BackendController@student')->name('admission.admin.student');
    Route::match(['get', 'post'],'/siswa/tambah', 'BackendController@studentadd')->name('admission.admin.studentadd');
    Route::match(['get', 'post'], '/keuangan', 'BackendController@finance')->name('admission.admin.finance');
    Route::match(['get', 'post'], '/pengguna', 'BackendController@user')->name('admission.admin.user');
    Route::match(['get', 'post'], '/pengaturan', 'BackendController@setting')->name('admission.admin.setting');
});
