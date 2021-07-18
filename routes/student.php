<?php

use Illuminate\Support\Facades\Route;
Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('student.login');
Route::match(['get', 'post'], '/keluar', 'AuthController@logout')->name('student.logout');
Route::group(['middleware' => 'auth.student'], function (){
    Route::match(['get', 'post'], '/', 'MainController@home')->name('student.home');
    Route::match(['get', 'post'], '/master/tahun', 'MasterController@year')->name('student.master.year');
    Route::match(['get', 'post'], '/master/jurusan', 'MasterController@major')->name('student.master.major');
    Route::match(['get', 'post'], '/master/kelas', 'MasterController@classes')->name('student.master.classes');
    Route::match(['get', 'post'], '/master/sekolah', 'MasterController@school')->name('student.master.school');
    Route::match(['get', 'post'], '/siswa/semua', 'MainController@student')->name('student.student.all');
    Route::match(['get', 'post'], '/siswa/{id}/detail', 'MainController@detail')->name('student.student.detail');
    Route::match(['get', 'post'], 'pengaturan', 'MainController@setting')->name('student.setting');
});
