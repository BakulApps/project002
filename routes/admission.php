<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'FrontedController@home')->name('admission.home');
Route::get('/autentikasi/{uuid}', 'FrontedController@authenticate')->name('admission.authenticate');
Route::get('/informasi', 'FrontedController@term')->name('admission.term');
Route::match(['get', 'post'],'/pendaftaran', 'FrontedController@register')->name('admission.register');
Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('admission.login');
Route::get('/keluar', 'AuthController@logout')->name('admission.logout');

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admission'], function (){
    Route::get('/', 'BackendController@home')->name('admission.admin.home');
    Route::match(['get', 'post'],'/siswa', 'BackendController@student')->name('admission.admin.student');
    Route::match(['get', 'post'],'/siswa/tambah', 'BackendController@studentadd')->name('admission.admin.studentadd');
    Route::get('/pengaturan', 'BackendController@setting')->name('admission.admin.setting');
});
