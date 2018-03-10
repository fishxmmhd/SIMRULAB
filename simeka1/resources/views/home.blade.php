@extends('layouts.app')

@section('htmlheader_title')
	Beranda
@endsection


@section('main-content')
	<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Ruangan</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <p align="right" style="padding-right: 15px">
            </p>
              <thead>
                <tr>
                  <th>Jam</th>
                  <th>Senin</th>
                  <th>Selasa</th>
                  <th>Rabu</th>
                  <th>Kamis</th>
                  <th>Jumat</th>
                  <th>Sabtu</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>08.00</td>
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td><button type="button" class="btn btn-primary btn-sm" class="nav-link" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <button type="button" class="btn btn-danger btn-sm" class="nav-link" data-toggle="modal" data-target="#delete">Delete</button>
                  </td>
                </tr>
                <tr>
                   <td>09.00</td>
                  <td>Tersedia</td>
                  <td>Tidak Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td><button type="button" class="btn btn-primary btn-sm" class="nav-link" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <button type="button" class="btn btn-danger btn-sm" class="nav-link" data-toggle="modal" data-target="#delete">Delete</button>
                  </td>                
                </tr>
                <tr>
                  <td>10.00</td>
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td><button type="button" class="btn btn-primary btn-sm" class="nav-link" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <button type="button" class="btn btn-danger btn-sm" class="nav-link" data-toggle="modal" data-target="#delete">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>11.00</td>
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td><button type="button" class="btn btn-primary btn-sm" class="nav-link" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <button type="button" class="btn btn-danger btn-sm" class="nav-link" data-toggle="modal" data-target="#delete">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>12.00</td>
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td><button type="button" class="btn btn-primary btn-sm" class="nav-link" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <button type="button" class="btn btn-danger btn-sm" class="nav-link" data-toggle="modal" data-target="#delete">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>13.00</td>
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td><button type="button" class="btn btn-primary btn-sm" class="nav-link" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <button type="button" class="btn btn-danger btn-sm" class="nav-link" data-toggle="modal" data-target="#delete">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>14.00</td>
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td><button type="button" class="btn btn-primary btn-sm" class="nav-link" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <button type="button" class="btn btn-danger btn-sm" class="nav-link" data-toggle="modal" data-target="#delete">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>15.00</td> 
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td><button type="button" class="btn btn-primary btn-sm" class="nav-link" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <button type="button" class="btn btn-danger btn-sm" class="nav-link" data-toggle="modal" data-target="#delete">Delete</button>
                  </td>
                </tr><tr>
                  <td>16.00</td>
                  <td>Tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td>Tidak tersedia</td>
                  <td>Tersedia</td>
                  <td><button type="button" class="btn btn-primary btn-sm" class="nav-link" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <button type="button" class="btn btn-danger btn-sm" class="nav-link" data-toggle="modal" data-target="#delete">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!-- Pesan Modal-->
    <div class="modal fade" id="pesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
                <div class="card-header">Peminjaman Ruangan</div>
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
                    <form role="form" method="POST" action="add_ruangan">
                         <div class="col-sm-12">
                            <label>Pilih Ruangan</label>
                                <select name="ruangan" class="form-control" autofocus>
                                <option value="{{ old('ruangan') }}" selected>{{ old('ruangan') }}</option>
                                </select>
                        </div>
                        <div class="col-sm-12">
                            <label>Informasi Ruangan</label>
                            <input class="form-control" placeholder="" name= "nama_ruangan" value="{{ old('nama_ruangan') }}" autofocus>
                        </div>
                         <div class="col-sm-12">
                            <label>Nama Kegiatan</label>
                            <input class="form-control" placeholder="" name= "nama_kegiatan" value="{{ old('nama_kegiatan') }}" autofocus>
                        </div>
                        <div class="col-sm-12">
                            <label> Deskripsi Kegiatan </label>
                            <textarea name="deskripsi" value="" class = "form-control" rows="8"autofocus></textarea>
                        </div>
                        <div class="col-sm-12">
                            <label>Waktu Peminjaman</label>
                            <div class="input-group date" id="datetimepicker">
                                <input type="date" class="form-control date" name="waktu_peminjaman" value="{{ old('waktu_peminjaman') }}" id="datepicker">
                                <span class="input-group-addon" id="datepicker">
                                </span>     
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            <button type="reset" class="btn btn-danger pull-right" style="margin-right: 10px;">Reset</button>
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

<!-- Delete Modal-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Click "Ok" if you are ready to delete</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Ok</a>
          </div>
        </div>
      </div>
    </div>
@endsection
