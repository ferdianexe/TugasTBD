<?php

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
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/register', 'Auth\RegisterController@createUser')->name('registerUser');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/TampilanDataPeminjaman', function(){
    return view('TampilanDataPeminjaman');
})->middleware('auth')->name("pinjamanBuku");
Route::get('/hasilCariBuku', 'SearchBookController@testParsingData')->name('searchBook');
