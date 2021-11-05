<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'FrontedController@home')->name('admission.home');
Route::get('/autentikasi/{uuid}', 'FrontedController@authenticate')->name('admission.authenticate');
Route::get('/informasi', 'FrontedController@term')->name('admission.term');
Route::match(['get', 'post'],'/pendaftaran', 'FrontedController@register')->name('admission.register');
Route::match(['get', 'post'], '/tagihan', 'FrontedController@invoice')->name('admission.invoice');
Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('admission.login');
Route::get('/keluar', 'AuthController@logout')->name('admission.logout');

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admission'], function (){
    Route::get('/', 'BackendController@home')->name('admission.admin.home');
    Route::match(['get', 'post'],'/master/sekolah', 'MasterController@school')->name('admission.admin.master.school');
    Route::match(['get', 'post'],'/master/program', 'MasterController@program')->name('admission.admin.master.program');
    Route::match(['get', 'post'],'/master/biaya', 'MasterController@cost')->name('admission.admin.master.cost');
    Route::match(['get', 'post'],'/master/daftarulang', 'MasterController@register')->name('admission.admin.master.register');
    Route::match(['get', 'post'],'/siswa', 'BackendController@student')->name('admission.admin.student');
    Route::match(['get', 'post'],'/siswa/tambah', 'BackendController@studentadd')->name('admission.admin.studentadd');
    Route::match(['get', 'post'], '/keuangan', 'BackendController@finance')->name('admission.admin.finance');
    Route::match(['get', 'post'], '/pengguna', 'BackendController@user')->name('admission.admin.user');
    Route::match(['get', 'post'], '/pengaturan', 'BackendController@setting')->name('admission.admin.setting');
});
