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
          <h2>Data Kegiatan</h2>
        </div>
        <div class="panel-body">     
          <table class="table table-striped table-responsive w-auto table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Kegiatan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody  id="kegiatan-info" name="kegiatan-info">
              <?php $number=0?>
              @foreach($data['kegiatan'] as $kegiatan)
              <?php $number++;?>
              <tr>
                <td>{{$number}}</td>
                <td>{{$kegiatan['jenis_kegiatan']}}</td>
                <td>
                  <form action={{"kegiatan/$kegiatan->id"}} method="post">
                   {{ method_field('DELETE')}} 
                   {{ csrf_field()}}
                   <button class="btn btn-danger btn-sm">
                    <strong>DELETE</strong>
                  </button>

                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ModalEditKegiatan{{$kegiatan->id}}">
                    <strong>EDIT</strong>
                  </button>

                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="col-xs-14 text-right">
          <button class="btn btn-primary btn-m" type="button" class="nav-link" data-toggle="modal" data-target="#tambahKegiatan">
            Tambah Kegiatan<!-- <span class="glyphicon glyphicon-plus-sign"></span> --> 
          </button>
        </div>
      </div>

      <!-- Modal Tambah Kegiatan -->
      <div class="modal fade" id="tambahKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <div class="card-header">Tambah Kegiatan</div>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <body class="bg-dark">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card card-default">
                      <div class="card-body">
                        <form role="form" method="POST" action="{{url('kegiatan/tambah')}}">
                         {{ csrf_field() }}
                         <div class="col-sm-12">
                          <label>Jenis Kegiatan</label>
                          <input class="form-control" placeholder="" name="jenis_kegiatan" autofocus>
                        </div>
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                      </form>
                    </div>
                  </div>    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal Edit Kegiatan -->
      @foreach($data['kegiatan'] as $kegiatan)
      <div class="modal fade" id="ModalEditKegiatan{{$kegiatan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <div class="card-header">
                <label>Edit Kegiatan</label>
              </div>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <body class="bg-dark">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card card-default">
                      <div class="card-body">
                       <form role="form" method="POST" action="{{url('/kegiatan/'.$kegiatan->id)}}">
                        {{ method_field('PUT')}}
                        {{ csrf_field() }}
                        <div class="col-sm-12">
                          <label> Nama Kegiatan </label>
                          <input type="text" name="jenis_kegiatan" value="{{$kegiatan->jenis_kegiatan}}" class="form-control" rows="8">
                        </div>
                        <br>
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                      </form>
                    </div>
                  </div>    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
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
