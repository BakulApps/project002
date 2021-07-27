<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', 'MainController@home')->name('simadu.home');
Route::match(['get', 'post'], '/data', 'MainController@data')->name('simadu.data');
Route::match(['get', 'post'], '/profil', 'MainController@profile')->name('simadu.profile');
Route::match(['get', 'post'], '/akademik/jadwal', 'AcademicController@schedule')->name('simadu.academic.schedule');
Route::match(['get', 'post'], '/akademik/kehadiran', 'AcademicController@presence')->name('simadu.academic.presence');
Route::match(['get', 'post'], '/akademik/raport', 'AcademicController@report')->name('simadu.academic.report');
Route::match(['get', 'post'], '/keuangan/tagihan', 'FinanceController@invoice')->name('simadu.finance.invoice');
Route::match(['get', 'post'], '/keuangan/pembayaran', 'FinanceController@payment')->name('simadu.finance.payment');
Route::match(['get', 'post'], '/keuangan/pembayaran/notifikasi', 'FinanceController@notify')->name('simadu.finance.notify');
Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('simadu.login');
Route::match(['get', 'post'], '/keluar', 'AuthController@logout')->name('simadu.logout');

Route::match(['get', 'post'], '/test', 'FinanceController@test');
