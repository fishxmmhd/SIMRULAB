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
            <legend>Data Ruangan</legend>

          </div>
        </div>

        <div class="panel-body">
          <div class="table-responsive">

           <table id="example1" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas Ruangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody  id="ruangan-info" name="ruangan-info">
              <?php $number=0?>
              @foreach($data['ruangan'] as $ruangan)
              <?php $number++?>
              <tr>
                <td>{{$number}}</td>
                <td>{{$ruangan['nama_ruangan']}}</td>
                <td>{{$ruangan['kapasitas_ruangan']}}</td>
                <td>
                  <form action={{"ruangan/$ruangan->id"}} method="post">
                    {{ method_field('DELETE')}} 
                    {{ csrf_field()}}
                    <button class="btn btn-danger btn-sm">
                      <strong>DELETE</strong>
                    </button>

                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modaleditruangan{{$ruangan->id}}">
                      <strong>EDIT</strong>
                    </button>

                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="col-xs-14 text-right">
            <button class="btn btn-primary btn-m" type="button" class="nav-link" data-toggle="modal" data-target="#tambahRuangan">
              Tambah Ruangan
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal Edit Ruangan -->
    @foreach($data['ruangan'] as $ruangan)
    <div class="modal fade" id="modaleditruangan{{$ruangan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="card-header">
              <label>Edit Ruangan</label>
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
                     <form role="form" method="POST" action="{{url('/ruangan/'.$ruangan->id)}}">
                      {{ method_field('PUT')}}
                      {{ csrf_field() }}
                      <div class="col-sm-12">
                        <label> Nama Ruangan </label>
                        <input type="text" name="nama_ruangan" value="{{$ruangan->nama_ruangan}}" class="form-control" rows="8">
                      </div>
                      <div class="col-sm-12">
                        <label> Kapasitas Ruangan </label>
                        <input type="text" name="kapasitas_ruangan" value="{{$ruangan->kapasitas_ruangan}}" class="form-control" rows="8">
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


    <!-- Modal Tambah Ruangan -->
    <div class="modal fade" id="tambahRuangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="card-header">Tambah Ruangan</div>
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
                  <form role="form" method="POST" action="{{url('ruangan/tambah')}}">
                    {{ csrf_field() }}
                    <div class="col-sm-12">
                     <label>Nama Ruangan</label>
                     <input class="form-control" placeholder="" name= "nama_ruangan"  autofocus>
                   </div>
                   <div class="col-sm-12">
                     <label>Kapasitas Ruangan</label>
                     <input class="form-control" placeholder="" name= "kapasitas_ruangan"  autofocus>
                   </div>
                   <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                  </form>
                </div>    
              </div>
            </div>
          </div>
        </div>
      </div> 
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
