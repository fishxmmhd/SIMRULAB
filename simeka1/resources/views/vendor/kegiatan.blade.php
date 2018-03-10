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
  <h2>Table</h2>
            
  <table class="table table-striped table-responsive w-auto table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Jenis Kegiatan</th>
      </tr>
    </thead>
    <tbody>
      <?php $number=0?>
      @foreach($data['kegiatan'] as $kegiatan)
      <?php $number++;?>
      <tr>
        <td>{{$number}}</td>
        <td>{{$kegiatan['jenis_kegiatan']}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

         <div class="col-xs-14 text-right">
        <button class="btn btn-primary btn-m" type="button" class="nav-link" data-toggle="modal" data-target="#tambahPemakaian">
          Tambah Kegiatan<!-- <span class="glyphicon glyphicon-plus-sign"></span> --> 
        </button>
    </div>
</div>

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
              <div class="container">
                <div class="row">
        <div class="col-md-6">
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
    </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>

@endsection
