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
      if(Auth::user()->role==2){
      	return redirect('status');
      }else{
	    return redirect('pemakaian');
		}
});

Route::get('/submenu', function () {
    return view('submenu2'); 
});

Route::get('/pinjam', function () {
    return view('vendor/pinjam');
});

//homeadmin
Route::get('/status', 'HomeController@index');
Route::get('/status/{id}', 'HomeController@update');
Route::get('/status/rekap/{ruangan}', 'HomeController@indexstatus');

//pemakaian
Route::get('/pemakaian','HomeController@pemakaian');
Route::post('/pemakaian/tambah','HomeController@tambah_pemakaian');
Route::put('/pemakaian/{id}','HomeController@update_pemakaian'); //edit
Route::get('/pemakaian/cek/{tanggal}/{tanggal_mulai}/{tanggal_selesai}/{ruangan}','HomeController@cek_pemakaian');

//pemakaianadmin
Route::get('/pemakaianadmin','HomeController@pemakaian_admin');
Route::post('/pemakaianadmin/tambah','HomeController@tambah_pemakaian_admin');
Route::put('/pemakaianadmin/{id}','HomeController@update_pemakaian_admin');

//ruangan
Route::get('/ruangan','HomeController@ruangan');
Route::post('/ruangan/tambah','HomeController@tambah_ruangan');
Route::put('/ruangan/{id}','HomeController@update_ruangan'); //edit

//kegiatan
Route::get('/kegiatan','HomeController@kegiatan');
Route::post('/kegiatan/tambah','HomeController@tambah_kegiatan');
Route::put('/kegiatan/{id}','HomeController@update_kegiatan'); //edit

//deletePemakaian
Route::delete('/pemakaian/{id}/','HomeController@destroyPemakaian');
Route::delete('/pemakaianadmin/{id}','HomeController@destroyPemakaian_admin');
//deleteRuangan
Route::delete('/ruangan/{id}','HomeController@destroyRuangan');

//deleteKegiatan
Route::delete('/kegiatan/{id}','HomeController@destroyKegiatan');

//tabelruangan
Route::get('/formpengaduan', 'HomeController@formpengaduan'); //formpengaduan
Route::post('/formpengaduan/{id}', 'HomeController@tambahformpengaduan');

Route::get('/daftarpengaduan', 'HomeController@daftarpengaduan');
/*//edit
Route::resource('/pemakaian/{id}','HomeController@update');*/


///////////////////=============================================================///////////////////////////////////////////// TAMBAHAN BLADE REPORT
///TAMBAHAN 29.04.2018
Route::get('excelpemakaianadmin','HomeController@excelPemakaianAdmin')->name('home.excelpemakaianadmin'); //NYOBAAAAAAAAAAAAAEXCEL

//laporan
Route::get('/report','HomeController@report');