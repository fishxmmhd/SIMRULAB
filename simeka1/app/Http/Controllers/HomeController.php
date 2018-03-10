<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Kegiatan;
use App\Ruangan;
use App\Pemakaian;
use App\Informasi;
use Carbon\Carbon;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('home2');
    }

    public function submenu()
    {
        return view('submenu2');
    }

    public function pinjam()
    {
        return view('pinjam');
    }

    public function informasi()
    {
        $data['pemakaian'] = Pemakaian::join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->get();
        $data['ruangan'] = Ruangan::get();
        $data['kegiatan'] = Kegiatan::get();
        return view('informasi',compact('data'));
    }


    public function pemakaian()
    {
        $user_id = auth()->user()->id;
        $data['pemakaian'] = Pemakaian::where('user_id',$user_id)->join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->get();
        $data['ruangan'] = Ruangan::get();
        $data['kegiatan'] = Kegiatan::get();
        return view('pemakaian',compact('data'));
    }

    public function tambah_pemakaian(Request $request)
    {
        $tanggal = $request->tanggal_peminjaman;
        $waktu_mulai = $request->waktu_mulai;
        $waktu_selesai = $request->waktu_selesai;
        $tanggal_mulai = $tanggal." ".$waktu_mulai.":00";
        $tanggal_selesai = $tanggal." ".$waktu_selesai.":00";
      /*  $pemakaians = Pemakaian::whereDate('tanggal_mulai', '=', $tanggal)->get();
        foreach ($pemakaians as $pemakaian) {
            $tanggal_mulai=strtotime($tanggal_mulai);
            $tanggal_selesai=strtotime($tanggal_selesai);
            // $timestamp = Carbon::createFromFormat('Y-m-d H:i:s', $pemakaian->tanggal_mulai)->timestamp;
            $pemakaian->tanggal_mulai=strtotime($pemakaian->tanggal_mulai);
            dd($pemakaian->tanggal_mulai, $pemakaian->tanggal_mulai, gettype(date('now')));
            $pemakaian->tanggal_selesai=strtotime($pemakaian->tanggal_selesai);
            if(($tanggal_mulai->gte($pemakaian->tanggal_mulai) && $tanggal_mulai->lte($pemakaian->tanggal_selesai)) || ($tanggal_selesai->gte($pemakaian->tanggal_mulai) && $tanggal_selesai->lte($pemakaian->tanggal_selesai)) || ($pemakaian->$tanggal_mulai->gte($tanggal_mulai) && $pemakaian->tanggal_mulai->lte($tanggal_selesai)) || ($pemakaian->$tanggal_selesai->gte($tanggal_mulai) && $pemakaian->tanggal_selesai->lte($tanggal_selesai))){
                dd('wkwkkw');
            }
        }
        dd($request, $tanggal_mulai, $pemakaian);*/
        $pemakaian = new Pemakaian;
        $pemakaian->user_id = auth()->user()->id;
        $pemakaian->ruangan_id = $request->ruangan;
        $pemakaian->kegiatan_id = $request->jenis_kegiatan;
        $pemakaian->tanggal_mulai = $tanggal_mulai;
        $pemakaian->tanggal_selesai = $tanggal_selesai;
        $pemakaian->save();
        return redirect('pemakaian');

    }

     public function ruangan()
    {
        $data['ruangan'] = Ruangan::get();
        return view('ruangan',compact('data'));
    }

    public function tambah_ruangan(Request $request)
    {
        $ruangan = new Ruangan;
        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->kapasitas_ruangan = $request->kapasitas_ruangan;
        $ruangan->save();
        return redirect('/ruangan');
    }

     public function kegiatan()
    {
        $data['kegiatan'] = Kegiatan::get();
        return view('vendor/kegiatan',compact('data'));
    }

    public function tambah_kegiatan(Request $request)
    {
        $kegiatan = new Kegiatan;
        $kegiatan->jenis_kegiatan = $request->jenis_kegiatan;
        $kegiatan->save();
        return redirect('/kegiatan');
    }
}