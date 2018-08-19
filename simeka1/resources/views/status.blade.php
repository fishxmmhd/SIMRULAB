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
  <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.min.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>
  <body>
    <section class="content">
      <div class="row">
        <div class="box">
          <div class="box-header">
            <div class="container-fluid">

              <div class="panel-body">
                <div class="form-group">
                  <label>Pilih Ruangan</label>
                  <select name="ruangan"  id="rekapdata" class="form-control" autofocus>
                    @foreach($data['ruangan'] as $ruangan)
                    <option value="{{$ruangan['id']}}">{{$ruangan['nama_ruangan']}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="table-responsive">
                  <table id="example" class="table table-responsive table-bordered table-striped" >
                    <legend>Status Pemakaian</legend>
                    <thead>
                      <tr>
                        <th>No</th>
                         <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Nama Ruangan</th>
                        <th>Jenis Kegiatan</th>
                        <th>Pemakai</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="pemakaian-info" name="pemakaian-info">
                    </tbody>
                  </table>
                </div>
              </div>

            </section>
            <script>
              $(function () {
                $('#example1').DataTable()
                $('#example2').DataTable({
                  'paging'      : true,
                  'lengthChange': false,
                  'searching'   : false,
                  'ordering'    : true,
                  'info'        : true,
                  'autoWidth'   : false
                })
              })
            </script>
          </body>
          </html>

          @endsection