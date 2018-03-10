<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Kegiatan;
use App\Ruangan;
use App\Pemakaian;
use App\Informasi;

class InformasiController extends Controller
{
    public function informasi()
    {
        $data['pemakaian'] = Pemakaian::join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->orderBy('tanggal_mulai','asc')->get();
        $data['ruangan'] = Ruangan::get();
        $data['kegiatan'] = Kegiatan::get();
        return view('vendor.informasi',compact('data'));
    }
}
