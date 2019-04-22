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
    $isAdmin = FALSE;
    if(Auth::user()->hakStatus==1){
      $isAdmin = TRUE;  
    }
    return view('welcome',compact('isAdmin'));
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/register', 'Auth\RegisterController@createUser')->name('registerUser');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/TampilanDataPeminjaman', 'DataPeminjamanController@index')->middleware('auth')->name("pinjamanBuku");

Route::get('/hasilCariBuku', 'SearchBookController@testParsingData')->name('searchBook');
Route::get('/tambahbuku', function(){
    return view('tambahBuku');
})->middleware('auth')->name("tambahBuku");
Route::get('/tambaheksemplar', function(){
    return view('tambahEksemplar');
})->middleware('auth')->name("tambahEksemplar");
Route::get('/pemesanan', function(){
    return view('TampilanDataPemesanan');
})->middleware('auth')->name("pemesananBuku");
Route::get('/anggota', function(){
    return view('TampilanAnggota');
})->middleware('auth')->name("seluruhanggota");
Route::get('/TampilanDetailBuku/{id}', "BukuDanEksemplar@index")->middleware('auth')->name("TampilanDetailBuku");