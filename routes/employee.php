<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('employee.login');
Route::get('/keluar', 'AuthController@logout')->name('employee.logout');
Route::match(['get', 'post'], '/', 'MainController@home')->name('employee.home');
Route::match(['get', 'post'], '/absensi', 'MainController@present')->name('employee.present');

