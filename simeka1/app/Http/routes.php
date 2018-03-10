<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','InformasiController@informasi');

Route::get('/home', function () {
    return view('home2');
});

/*Route::get('/submenu', function () {
    return view('vendor/submenu'); 
});*/

Route::get('/submenu', function () {
    return view('submenu2'); 
});

Route::get('/pinjam', function () {
    return view('vendor/pinjam');
});

//pemakaian
Route::get('/pemakaian','HomeController@pemakaian');
Route::post('/pemakaian/tambah','HomeController@tambah_pemakaian');

//ruangan
Route::get('/ruangan','HomeController@ruangan');
Route::post('/ruangan/tambah','HomeController@tambah_ruangan');

//kegiatan
Route::get('/kegiatan','HomeController@kegiatan');
Route::post('/kegiatan/tambah','HomeController@tambah_kegiatan');
