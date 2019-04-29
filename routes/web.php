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
Route::get('/', 'HalamanDepanController@index')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/register', 'Auth\RegisterController@createUser')->name('registerUser');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/TampilanDataPeminjaman', 'DataPeminjamanController@index')->middleware('auth')->name("pinjamanBuku");

Route::get('/hasilCariBuku', 'SearchBookController@testParsingData')->name('searchBook');
Route::get('/tambaheksemplar', function(){
    return view('tambahEksemplar');
})->middleware('auth')->name("tambahEksemplar");
Route::get('/pemesanan', function(){
    return view('TampilanDataPemesanan');
})->middleware('auth')->name("pemesananBuku");
Route::get('/TampilanDetailBuku/{id}','BukuDanEksemplarController@index' )->middleware('auth')->name("TampilanDetailBuku");
Route::get('/tambahkategori', "KategoriController@showAllCategory")->middleware('auth')->name("tambahKategori");
Route::get('/tambahpenerbit', "PenerbitController@showAllPenerbit")->middleware('auth')->name("tambahPenerbit");
Route::get('/tambahpengarang', "PengarangController@showAllPengarang")->middleware('auth')->name("tambahPengarang");
Route::post('/tambahpengarang', "PengarangController@insertPengarang")->middleware('auth')->name("insertPengarang");
Route::post('/tambahkategori',"KategoriController@insertKategori")->middleware('auth')->name("insertKategori");
Route::post('/tambahpenerbit',"PenerbitController@insertPenerbit")->middleware('auth')->name("insertPenerbit");
Route::post('/tambahBuku',"BukuController@tambahBuku")->middleware('auth')->name("tambahbukuform");
Route::get('/tambahBuku', "BukuController@loadNamaPenerbitdanPengarang")->middleware('auth')->name("tambahBuku");
Route::get('/anggota', 'ShowUserController@showAllUser')->middleware('auth')->name("seluruhanggota");

Route::get('/showAturanDenda', 'DendaController@showAllAturan')->middleware('auth')->name("showAturanDenda");
Route::get('/tambahAturanDenda', 'DendaController@tambahAturanDenda')->middleware('auth')->name("tambahAturanDenda");
Route::get('/updateAturanDenda', 'DendaController@updateAturanDenda')->middleware('auth')->name("updateAturanDenda");
Route::get('/showDendaKu', 'DendaController@showDendaKu')->middleware('auth')->name("showDendaKu");
