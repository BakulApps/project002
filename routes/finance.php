<?php
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('finance.login');
Route::get('/keluar', 'AuthController@logout')->name('finance.logout');
Route::group(['middleware' => 'auth.finance'], function (){
    Route::match(['get', 'post'], '/', 'BackendController@home')->name('finance.home');
    Route::match(['get', 'post'], '/master/item', 'BackendController@item')->name('finance.master.item');
    Route::match(['get', 'post'], '/master/rekening', 'BackendController@account')->name('finance.master.account');
    Route::match(['get', 'post'], '/siswa', 'BackendController@student')->name('finance.student');
    Route::match(['get', 'post'], '/tagihan', 'BackendController@invoice')->name('finance.invoice');
    Route::match(['get', 'post'], '/pembayaran', 'BackendController@payment')->name('finance.payment');
    Route::match(['get', 'post'], '/pembayaran/{id}/verifikasi', 'BackendController@verify')->name('finance.payment.verify');
    Route::match(['get', 'post'], '/pengguna', 'BackendController@user')->name('finance.user');
    Route::match(['get', 'post'], '/pengaturan', 'BackendController@setting')->name('finance.setting');
    Route::get('/test', 'BackendController@test');
});
