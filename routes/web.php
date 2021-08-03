<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('website.pages.kas');
// });



Route::group(['namespace' => 'Website', 'as' => 'website.'], function() {
    Route::get('login', 'AuthController@showLoginPage')->name('auth.login');
    Route::post('login', 'AuthController@authenticate')->name('auth.authenticate');
    Route::get('/', 'HomeController@index')->name('home');
    Route::middleware('auth.web')->group(function () {
        Route::get('logout', 'AuthController@logout')->name('auth.logout');

        /*Kas */
        Route::get('/kas', 'KasController@index')->name('kas.index');
        Route::get('/ajax_akun', 'KasController@ajax_akun')->name('kas.ajax_akun');
        Route::post('/simpankas', 'KasController@simpan')->name('kas.simpan');
        // Route::get('/showkas', 'KasController@show')->name('kas.show');
        // Route::get('/ajax_showkas', 'KasController@ajax_show')->name('kas.ajax_show');
        Route::get('/show_history', 'KasController@show_history')->name('kas.show_history');
        Route::get('/report', 'KasController@report')->name('kas.report');

        /* Akun */
        Route::get('/akun', 'AkunController@index')->name('akun.index');
        Route::get('/ajaxakun', 'AkunController@ajax_index')->name('akun.ajax_index');
        Route::get('/tambahakun', 'AkunController@tambah')->name('akun.tambah');
        Route::post('/tambahakun', 'AkunController@simpan')->name('akun.simpan');

    });
});
