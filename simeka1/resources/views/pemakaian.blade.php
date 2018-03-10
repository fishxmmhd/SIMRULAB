@extends('layouts.app')

@section('htmlheader_title')
  Beranda
@endsection


@section('main-content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



     <section class="content">
      <div class="row">
        <div class="box">
        <div class="box-header">
          <div class="container-fluid">
            <h2>Data Pemakaian</h2>
                      
  <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <p align="right" style="padding-right: 15px">
            </p>
     <div style="margin-right: 900px;" class="col-xs-14 text-left">
        <label>Pilih Ruangan</label>
          <select name="ruangan" class="form-control" autofocus>
          @foreach($data['ruangan'] as $ruangan)
           <option value="{{$ruangan['id']}}">{{$ruangan['nama_ruangan']}}</option>
          @endforeach
          </select>
     </div>

    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Waktu Mulai</th>
        <th>Waktu Selesai</th>
        <th>Nama Ruangan</th>
        <th>Jenis Kegiatan</th>
        <th>Deskripsi</th>
      </tr>
    </thead>
    <tbody>
      <?php $number=0 ?> 
      @foreach($data['pemakaian'] as $pemakaian)
      <?php $number++?>  
        <tr>
          <td>{{$number}}</td>
          <td>{{date("d-m-Y",strtotime($pemakaian['tanggal_mulai']))}}</td>
          <td>{{date("H:i",strtotime($pemakaian['tanggal_mulai']))}}</td>
          <td>{{date("H:i",strtotime($pemakaian['tanggal_selesai']))}}</td>
          <td>{{$pemakaian['nama_ruangan']}}</td>
          <td>{{$pemakaian['jenis_kegiatan']}}</td>
          <td>deskripsi blm di masukin wkkw</td>
        </tr>
      @endforeach
    </tbody>
  </table>
    <div class="col-xs-14 text-right">
        <button class="btn btn-primary btn-m" type="button" class="nav-link" data-toggle="modal" data-target="#tambahPemakaian">
          Tambah Pemakaian<!-- <span class="glyphicon glyphicon-plus-sign"></span> --> 
        </button>
    </div>
</div>

    <div class="modal fade" id="tambahPemakaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
                <div class="card-header">Tambah Pemakaian</div>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <body class="bg-dark">
              <div class="container">
                <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-body">
                   <form role="form" method="POST" action="{{url('pemakaian/tambah')}}">
                        {{ csrf_field() }}
                        <div class="col-sm-12">
                            <label>Pilih Ruangan</label>
                                <select name="ruangan" class="form-control" autofocus>
                                  @foreach($data['ruangan'] as $ruangan)
                                    <option value="{{$ruangan['id']}}">{{$ruangan['nama_ruangan']}}</option>
                                  @endforeach
                                </select>
                        </div>
                         <div class="col-sm-12">
                            <label>Jenis Kegiatan</label>
                                <select name="jenis_kegiatan" class="form-control" autofocus>
                                  @foreach($data['kegiatan'] as $kegiatan)
                                    <option value="{{$kegiatan['id']}}">{{$kegiatan['jenis_kegiatan']}}</option>
                                  @endforeach
                                </select>

                        </div>
                        <div class="col-sm-12">
                            <label> Deskripsi Kegiatan </label>
                            <input type="text" name="deskripsi" value="" class = "form-control" rows="8">
                        </div>
                        <div class="col-sm-12">
                            <label>Tanggal Peminjaman</label>
                            <div class="input-group date" id="datetimepicker">
                                <input type="date" class="form-control date" name="tanggal_peminjaman" value="{{ old('waktu_peminjaman') }}" id="datepicker">
                                <span class="input-group-addon" id="datepicker">
                                </span>     
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label> Waktu Mulai </label>
                            <input type="time" class="form-control date" name="waktu_mulai" value="{{ old('waktu_mulai') }}">
                        </div>
                        <div class="col-sm-12">
                            <label> Waktu Selesai </label>
                           <input type="time" class="form-control date" name="waktu_selesai" value="{{ old('waktu_selesai') }}">
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>    
        </div>
    </div>
              </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
    </div>
</section>

</body>
</html>

@endsection
