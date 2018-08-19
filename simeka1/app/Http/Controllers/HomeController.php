<?php
namespace App\Http\Controllers;

use Log;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Kegiatan;
use App\Ruangan;
use App\Pemakaian;
use App\Informasi;
use App\Pengaduan;
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
    public function index() /*status/statuscontroller 'admin'*/
    {
        $user_id = auth()->user()->id;
        $data['pemakaian'] = Pemakaian::whereDate('tanggal_mulai','>=',date("Y-m-d"))->join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->join('users','user_id','=','users.id')->orderBy('tanggal_mulai','asc')->select('pemakaians.id as id','tanggal_mulai','tanggal_selesai','nama_ruangan','jenis_kegiatan','deskripsi','status','name')->get();
        /* dd($data['pemakaian']);*/
        $data['ruangan'] = Ruangan::get();
        $data['kegiatan'] = Kegiatan::get();  
        return view('status',compact('data'));
    }

    public function indexstatus(Request $request, $id) /*status/statuscontroller 'admin'*/
    {
        $user_id = auth()->user()->id;
        $data['pemakaian'] = Pemakaian::where('ruangan_id')->whereDate('tanggal_mulai','>=',date("Y-m-d"))->join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->join('users','user_id','=','users.id')->orderBy('tanggal_mulai','asc')->select('pemakaians.id as id','tanggal_mulai','tanggal_selesai','nama_ruangan','jenis_kegiatan','deskripsi','status','name')->get();
        /* dd($data['pemakaian']);*/
        foreach ($data['pemakaian'] as $key => $data) {
            $data['user'][$key] = $data->user->name;
            $data['ruangan'][$key] = $data->ruangan->nama_ruangan;
        }
        // $data['ruangan'] = Ruangan::get();
        $data['kegiatan'] = Kegiatan::get();  
        $data['pemakaian'] = Pemakaian::get();
        return ['data'=> $data];
    }

    public function update(Request $request, $id)
    {
        // dd($request->status);
        $pemakaian = Pemakaian::find($id);
        if($request->status== 'Diterima'){
            $pemakaian->status = '1';   
        }else{
            $pemakaian->status = '2';
        }
        $pemakaian->save();
        return redirect('/status');
    }

  /*  public function informasi()
    {
        $data['pemakaian'] = Pemakaian::join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->get();
        $data['ruangan'] = Ruangan::get();
        $data['kegiatan'] = Kegiatan::get();
        return view('informasi',compact('data'));
    }*/

    public function destroyPemakaian($id)
    {
        $pemakaian = Pemakaian::find($id);
        $pemakaian->delete();

        return redirect('/pemakaian');
    }

    public function destroyPemakaian_admin($id)
    {
        $pemakaian = Pemakaian::find($id);
        $pemakaian->delete();

        return redirect('/pemakaianadmin');
    }

    public function destroyRuangan($id)
    {

        $ruangan = Ruangan::find($id);
        $ruangan->delete();

        return redirect('/ruangan');
    }

    public function destroyKegiatan($id)
    {

        $kegiatan = Kegiatan::find($id);
        $kegiatan->delete();

        return redirect('/kegiatan');
    }

   /* //edit
    public function edit($pemakaian)
    {
        return view('pemakaian',compact('pemakaian','page'));
    }

    public function update(Request $request, $member)
    {
        request()->validate({
            'pemakaian' => 'required',
            'ruangan' => 'required',
            'kegiatan' => 'required',
        })
        $pemakaian = Pemakaian::find($member);
        $pemakaian->pemakaian = $request->pemakaian;
        $pemakaian->ruangan = $request->ruangan;
        $pemakaian->kegiatan = $request->kegiatan;
        $pemakaian->save();
        return redirect()->route('pemakaian')->with('success','Pemakaian berhasil diubah');
    }

*/

    public function pemakaian()
    {
        $user_id = auth()->user()->id;
        $data['pemakaian'] = Pemakaian::where('user_id',$user_id)->whereDate('tanggal_mulai','>=',date("Y-m-d"))->join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->orderBy('tanggal_mulai','asc')->select('pemakaians.id as id','tanggal_mulai','tanggal_selesai','nama_ruangan','jenis_kegiatan','deskripsi','status')->get();
        /* dd($data['pemakaian']);*/
        $tgl = date("Y-m-d");
        $unix = strtotime($tgl);
        $hari = date("N", $unix);
        // dd($tgl, $unix, $hari);
        $data['pemakaiansemua'] = Pemakaian::whereDate('tanggal_mulai','>=',date("Y-m-d"))->join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->join('users','user_id','=','users.id')->where('status','1')->orderBy('tanggal_mulai','asc')->select('pemakaians.id as id','tanggal_mulai','tanggal_selesai','nama_ruangan','jenis_kegiatan','deskripsi','status','name')->get();
        $data['ruangan'] = Ruangan::orderBy('nama_ruangan', 'asc')->get();
        $data['kegiatan'] = Kegiatan::orderBy('jenis_kegiatan','asc')->get();
        return view('pemakaian',compact('data'));  
    }

    public function tambah_pemakaian(Request $request)
    {
     /* $user_id = auth()->user()->id;*/
     $tanggal = $request->tanggal_peminjaman;
     $waktu_mulai = $request->waktu_mulai;
     $waktu_selesai = $request->waktu_selesai;
     $tanggal_mulai = $tanggal." ".$waktu_mulai.":00";
     $tanggal_selesai = $tanggal." ".$waktu_selesai.":00";
     $unix = strtotime($tanggal);
     $hari = date("N", $unix);
     /*dd($hari, $tanggal);*/

     
     /*dd($request);*/
       // echo $tanggal."/".$tanggal_mulai."/".$tanggal_selesai;
        //dd($waktu_selesai);

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
        $hasil = $this->cek_pemakaian($tanggal,$tanggal_mulai,$tanggal_selesai,$request->ruangan);  
        // dd($hasil);
        if ($hasil['status']){
            $pemakaian = new Pemakaian;
            $pemakaian->user_id = auth()->user()->id;
            $pemakaian->ruangan_id = $request->ruangan;
            $pemakaian->kegiatan_id = $request->jenis_kegiatan;
            $pemakaian->tanggal_mulai = $tanggal_mulai;
            $pemakaian->tanggal_selesai = $tanggal_selesai;
            $pemakaian->deskripsi = $request->deskripsi;
            $pemakaian->save();
            return redirect('pemakaian');   
        }else{
            return  redirect()->back()->with('flash-message','Maaf, waktu yang anda pilih bentrok dengan pemakaian lain!');          
        }
            // return redirect('pemakaian');

    }

    function cek_pemakaian($tanggal,$tanggal_mulai,$tanggal_selesai,$ruangan)
    {
        Log::info("masuk ke cek ");
        $unix = strtotime($tanggal);
        $hari = date("N", $unix);
        $pemakaians = Pemakaian::whereDate('tanggal_mulai','=',$tanggal)->Where(function ($query) {
            $query->where('status', '0')
            ->orWhere('status', '1');
        })->where('ruangan_id',$ruangan)->get();
        $counter = 0 ;
        if($hari == 6 || $hari == 7){
            $libur = true;
        }
        else{
            $libur = false;
        }
        foreach($pemakaians as $pemakaian){
                // echo $tanggal_mulai."---".$pemakaian['tanggal_mulai']."<<<>>>".$tanggal_selesai."---".$pemakaian['tanggal_selesai']."<br>";
            if (strtotime($pemakaian['tanggal_mulai']) < strtotime($tanggal_selesai)){
                if (strtotime($pemakaian['tanggal_selesai']) > strtotime($tanggal_mulai)){
                    $counter++;
                }
            }
            else if (strtotime($pemakaian['tanggal_selesai']) > strtotime($tanggal_mulai)){
                if (strtotime($pemakaian['tanggal_mulai']) < strtotime($tanggal_selesai)){
                    $counter++;
                }
            }
            else if (strtotime($pemakaian['tanggal_mulai']) < strtotime($tanggal_mulai)){
                if (strtotime($pemakaian['tanggal_selesai']) > strtotime($tanggal_selesai)){
                    $counter++;
                }
            }
            else if (strtotime($pemakaian['tanggal_mulai']) > strtotime($tanggal_mulai)){
                if (strtotime($pemakaian['tanggal_selesai']) < strtotime($tanggal_selesai)){
                    $counter++;
                }
            }
            else if (strtotime($pemakaian['tanggal_mulai']) < strtotime($tanggal_mulai)){
                if (strtotime($pemakaian['tanggal_selesai']) > strtotime($tanggal_selesai)){
                    $counter++;
                }
            }
        }
        if ($counter == 0){
            return ['status'=>true,'libur'=>$libur];
        }else{
            return ['status'=>false,'libur'=>$libur];
        }
    }

 public function pemakaian_admin()
    {
        $user_id = auth()->user()->id;
        $data['pemakaian'] = Pemakaian::where('user_id',$user_id)->whereDate('tanggal_mulai','>=',date("Y-m-d"))->join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->orderBy('tanggal_mulai','asc')->select('pemakaians.id as id','tanggal_mulai','tanggal_selesai','nama_ruangan','jenis_kegiatan','deskripsi','status')->get();
        $data['pemakaianall'] = Pemakaian::whereDate('tanggal_mulai','>=',date("Y-m-d"))->join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->join('users','user_id','=','users.id')->where('status','1')->orderBy('tanggal_mulai','asc')->select('pemakaians.id as id','tanggal_mulai','tanggal_selesai','nama_ruangan','jenis_kegiatan','deskripsi','status','name')->get();
        /* dd($data['pemakaian']);*/
        $data['ruangan'] = Ruangan::orderBy('nama_ruangan', 'asc')->get();
        $data['kegiatan'] = Kegiatan::orderBy('jenis_kegiatan','asc')->get();
        return view('pemakaianadmin',compact('data'));  
    }

    public function tambah_pemakaian_admin(Request $request)
    {
     /* $user_id = auth()->user()->id;*/
     $tanggal = $request->tanggal_peminjaman;
     $waktu_mulai = $request->waktu_mulai;
     $waktu_selesai = $request->waktu_selesai;
     $tanggal_mulai = $tanggal." ".$waktu_mulai.":00";
     $tanggal_selesai = $tanggal." ".$waktu_selesai.":00";
     /*dd($request);*/
       // echo $tanggal."/".$tanggal_mulai."/".$tanggal_selesai;
        //dd($waktu_selesai);

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
        $hasil = $this->cek_pemakaian($tanggal,$tanggal_mulai,$tanggal_selesai,$request->ruangan);  
        // dd($hasil);
        if ($hasil){
            $pemakaian = new Pemakaian;
            $pemakaian->user_id = auth()->user()->id;
            $pemakaian->ruangan_id = $request->ruangan;
            $pemakaian->kegiatan_id = $request->jenis_kegiatan;
            $pemakaian->tanggal_mulai = $tanggal_mulai;
            $pemakaian->tanggal_selesai = $tanggal_selesai;
            $pemakaian->deskripsi = $request->deskripsi;
            $pemakaian->save();
            return redirect('pemakaianadmin');   
        }else{
            return  redirect()->back()->with('flash-message','Maaf, waktu yang anda pilih bentrok dengan pemakaian lain!');          
        }
            // return redirect('pemakaian');

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

    public function update_pemakaian(Request $request, $id){
        $tanggal = $request->tanggal_peminjaman;
        $waktu_mulai = $request->waktu_mulai;
        $waktu_selesai = $request->waktu_selesai;
        $tanggal_mulai = $tanggal." ".$waktu_mulai.":00";
        $tanggal_selesai = $tanggal." ".$waktu_selesai.":00";

        $hasil = $this->cek_pemakaian($tanggal,$tanggal_mulai,$tanggal_selesai,$request->ruangan);

        if ($hasil){
            $pemakaian = Pemakaian::find($id);
            $pemakaian->ruangan_id = $request->ruangan;
            $pemakaian->kegiatan_id = $request->jenis_kegiatan;
            $pemakaian->tanggal_mulai = $tanggal_mulai;
            $pemakaian->tanggal_selesai = $tanggal_selesai;
            $pemakaian->deskripsi = $request->deskripsi;
            $pemakaian->save();
            return redirect('pemakaian');
        }else{
            return  redirect()->back()->with('flash-message','Maaf, waktu yang anda pilih bentrok dengan pemakaian lain!');          
        }
    }

    public function update_pemakaian_admin(Request $request, $id){
        $tanggal = $request->tanggal_peminjaman;
        $waktu_mulai = $request->waktu_mulai;
        $waktu_selesai = $request->waktu_selesai;
        $tanggal_mulai = $tanggal." ".$waktu_mulai.":00";
        $tanggal_selesai = $tanggal." ".$waktu_selesai.":00";

        $hasil = $this->cek_pemakaian($tanggal,$tanggal_mulai,$tanggal_selesai,$request->ruangan);

        if ($hasil){
            $pemakaian = Pemakaian::find($id);
            $pemakaian->ruangan_id = $request->ruangan;
            $pemakaian->kegiatan_id = $request->jenis_kegiatan;
            $pemakaian->tanggal_mulai = $tanggal_mulai;
            $pemakaian->tanggal_selesai = $tanggal_selesai;
            $pemakaian->deskripsi = $request->deskripsi;
            $pemakaian->save();
            return redirect('pemakaianadmin');
        }else{
            return  redirect()->back()->with('flash-message','Maaf, waktu yang anda pilih bentrok dengan pemakaian lain!');          
        }
    }

    public function update_ruangan(Request $request, $id){
        $ruangan = Ruangan::find($id);
        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->kapasitas_ruangan = $request->kapasitas_ruangan;
        $ruangan->save();
        return redirect('/ruangan');
    }

    public function update_kegiatan(Request $request, $id){
        $kegiatan = Kegiatan::find($id);
        $kegiatan->jenis_kegiatan = $request->jenis_kegiatan;
        $kegiatan->save();
        return redirect('/kegiatan');
    }

    public function formpengaduan()
    {
        $user_id = auth()->user()->id;
        $data['pemakaian'] = Pemakaian::where('status',"=",'1')->where('user_id',$user_id)->whereDate('tanggal_mulai','>=',date("Y-m-d"))->join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->orderBy('tanggal_mulai','asc')->select('pemakaians.id as id','tanggal_mulai','tanggal_selesai','nama_ruangan','jenis_kegiatan','deskripsi','status')->get();
        return view('formpengaduan',compact('data'));  
    }

    public function tambahformpengaduan(Request $request)
    {
        $user_id = auth()->user()->id;
        $pengaduan = new Pengaduan;
        $pengaduan->id_pemakaian = $request->pilih_pemakaian;
        $pengaduan->isi_pengaduan = $request->isi_pengaduan;  
        $pengaduan->save();
        return redirect('formpengaduan');  
    }

    public function daftarpengaduan()
    {
       $data['pemakaian'] = Pemakaian::whereDate('tanggal_mulai','>=',date("Y-m-d"))->join('ruangans','ruangan_id','=','ruangans.id')->join('kegiatans','kegiatan_id','=','kegiatans.id')->join('users','user_id','=','users.id')->where('status','1')->orderBy('tanggal_mulai','asc')->select('pemakaians.id as id','tanggal_mulai','tanggal_selesai','nama_ruangan','jenis_kegiatan','deskripsi','status','name')->get();
        return view('daftarpengaduan',compact('data'));  
    }

///////////////////////////////////========================================================================================/////////////////////////
        //coba export excel
    public function excelPemakaianAdmin()
    {
        $pemakaians = DB::table('pemakaians')->get();

        $pemakaianData = "";

        if(count($pemakaians) >0 ){
            $pemakaianData .= '<table>
            <body>
            <h4> Tabel 3.3 Data pembinaan non-akademik yang diselenggarakan di level FMIPA baik oleh Fakultas maupun Organisasi Kemahasiswaan tingkat FMIPA</h4>
            <table border="1">
            <tr>
            <th>
            <th width="100px" style="border:1px solid #000; border-width: thin; background-color:#daeef3;" style="font-size:12px"><font face="Arial">Tanggal</font></th>
            <th width="100px" style="border:1px solid #000; border-width: thin; background-color:#daeef3;" style="font-size:12px"><font face="Arial">Waktu Mulai</font></th>
            <th width="100px" style="border:1px solid #000; border-width: thin; background-color:#daeef3;" style="font-size:12px"><font face="Arial">Waktu Selesai</font></th>
            <th width="100px" style="border:1px solid #000; border-width: thin; background-color:#daeef3;" style="font-size:12px"><font face="Arial">Nama Ruangan</font></th>
            <th width="100px" style="border:1px solid #000; border-width: thin; background-color:#daeef3;" style="font-size:12px"><font face="Arial">Jenis Kegiatan</font></th>
            </tr></th>';

            foreach ($pemakaians as $pemakaians) {
                $pemakaianData .= '

                <tr>
                <th>
                <td style= "border: 1px solid black">'.$pemakaians->tanggal_mulai.'</td>
                <td style= "border: 1px solid black">'.$pemakaians->tanggal_mulai.'</td>
                <td style= "border: 1px solid black">'.$pemakaians->tanggal_selesai.'</td>
                <td style= "border: 1px solid black">'.$pemakaians->nama_ruangan.'</td>
                <td style= "border: 1px solid black">'.$pemakaians->jenis_kegiatan.'</td>
                </tr></th>
                </table>
                </body>';
            }
            $pemakaianData .='</table>';
        }

        header('Content-Type: application.xls');
        header('Content-Disposition: attachment; filename=Report Pemakaian.xls');
        echo $pemakaianData;
    }

    public function report()
    {

        return view('report',compact('data'));  
    }
}