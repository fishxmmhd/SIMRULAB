<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
  <!--   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }} ">
    <meta name="author" content="Sergi Tur Badenas - acacha.org">

    <meta property="og:title" content="Adminlte-laravel" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }}" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org/" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x600.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x314.png" />
    <meta property="og:sitename" content="demo.adminlte.acacha.org" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@acachawiki" />
    <meta name="twitter:creator" content="@acacha1" /> -->

    <title>{{ trans('SIMRULAB') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/js/smssoothscroll.js') }}"></script>


  </head>

  <body>
    <section class="content">
      <!-- Fixed navbar -->
      <div id="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid full">
          <div class="navbar-header">
           <!--  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
          -->   <a class="navbar-brand" href="/"><b>SIMRULAB</b></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
            <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
            <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
            @else
            <li><a href="/home">{{ Auth::user()->name }}</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- <div id="bg-img-section"> -->
      <div class="box">
        <div class="box-header">
          <div class="container-fluid">
           <h2>Informasi Ruangan</h2>
           
                    <!-- <input class="form-control" id="dataTable" type="text" placeholder=" ">
                     -->  <!-- <div class="row table-center">
                     --> 
                     <div class="panel-body">
                    <!--     <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x-panel">
                  --><div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Waktu Mulai</th>
                          <th>Waktu Selesai</th>
                          <th>Nama Ruangan</th>
                          <th>Jenis Kegiatan</th>
                          <th>Deskripsi</th>
                          <th>Pemakai</th>
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
                          <td>{{$pemakaian['deskripsi']}}</td>
                          <td>{{$pemakaian['name']}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </section>
        @section('scripts')
        @include('layouts.partials.scripts')
        
        @show
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
<!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

</body>
</html>