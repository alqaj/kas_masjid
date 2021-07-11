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
    Route::middleware('auth.web')->group(function () {
        Route::get('logout', 'AuthController@logout')->name('auth.logout');
        Route::view('/', 'website.pages.kas');
        Route::get('/kas', function () {
            return view('website.pages.kas');
        })->name('kas');
        Route::get('/ajax_akun', 'KasController@ajax_akun')->name('kas.ajax_akun');
        Route::post('/simpankas', 'KasController@simpan')->name('kas.simpan');
        Route::get('/showkas', 'KasController@show')->name('kas.show');
    });
});
