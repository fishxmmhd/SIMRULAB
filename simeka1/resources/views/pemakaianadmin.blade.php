@extends('layouts.app')

@section('htmlheader_title')
Beranda
@endsection


@section('main-content')



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  
  <!-- <link rel="stylesheet" href="{{ asset('/plugins/prophetjs-master/build/css/prophet.css') }}">
  <script src="{{ asset('/plugins/prophetjs-master/build/js/prophet.js') }}"></script>
   -->


<script>
  $( function() {
    var $signupForm = $( '#SignupForm' );
    var stepvalidated = false;
    $signupForm.validate({
      errorElement: 'em',
      submitHandler: function (form) { 
        //alert('submitted');
        form.submit();
      }
    });
    
    $signupForm.formToWizard({
      submitButton: 'SaveAccount',
      nextBtnClass: 'btn btn-primary next',
      prevBtnClass: 'btn btn-default prev',
      buttonTag:    'button',
      validateBeforeNext: function(form, step) {
        
        console.log(url)
        
      },
      progress: function (i, count) {
        $('#progress-complete').width(''+(i/count*100)+'%');
      }
    });
  });

  var hari = document.getElementById("tanggalinput");
  hari.addEventListener("change", function(e){
    var har = 3;
    console.log(hari);
  }, false);
</script>

</head>
<body>



 <section class="content">
  <div class="row">
      <!--       <div class="alert alert-danger" role="alert">
            This is a danger alert—check it out!b
      </div>        
    -->          
    @if(Session::has('flash-message'))
    <div class="alert alert-danger">{{Session::get('flash-message')}}</div>
    @endif

   <!--  <div class="col-md-offset-10">
      <input class="form-control" id="dataTable" type="text" placeholder="Cari">
    </div>
  </div> -->
 <!--  <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'Riwayat Penggunaan')">Riwayat Penggunaan</button>
    <button class="tablinks" onclick="openCity(event, 'Tambah Pemakaian')">Tambah pemakaian</button>
    <button class="tablinks" onclick="openCity(event, 'Data Penggunaan')">Data penggunaan</button>
  </div> -->
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#riwayat_penggunaan" data-toggle="tab">Riwayat Penggunaan</a></li>
      <li><a href="#tambah_pemakaian" data-toggle="tab">Tambah Pemakaian</a></li>
      <li><a href="#data_pemakaian" data-toggle="tab">Data Penggunaan</a></li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active" id="riwayat_penggunaan">
        <legend>Ruangan yang anda gunakan</legend>
        <div class="table-responsive">
          <table id="example" class="table table-bordered table-striped">
            <!--  -->

            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Nama Ruangan</th>
                <th>Jenis Kegiatan</th>
                <th>Status</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="pemakaian-info" name="pemakaian-info">
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
                <td>
                  @if($pemakaian->status==0)
                  Menunggu
                  @elseif($pemakaian->status==1)
                  Diterima
                  @else
                  Ditolak
                  @endif
                </td>
                <td>{{$pemakaian['deskripsi']}}</td>
                <td> 
                  @if($pemakaian['status']==0) 
                  <form action="{{url('/pemakaianadmin/'.$pemakaian->id)}}"" method="post">
                    {{ method_field('DELETE')}} 
                    {{ csrf_field()}}
                    <button class="btn btn-danger btn-xs">
                      <strong>DELETE</strong>
                    </button>

                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalEdit{{$pemakaian->id}}">
                      <strong>EDIT</strong>
                    </button>

                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ModalDetail{{$pemakaian->id}}">
                      <strong>DETAIL</strong>
                    </button>

                  </form> 
                  @else
                  <form action="{{url('/pemakaianadmin/'.$pemakaian->id)}}"" method="post">
                    {{ method_field('DELETE')}} 
                    {{ csrf_field()}}
                    <button class="btn btn-danger btn-xs">
                      <strong>DELETE</strong>
                    </button>

                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ModalDetail{{$pemakaian->id}}">
                      <strong>DETAIL</strong>
                    </button>

                  </form> 
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- <div class="col-xs-14 text-right">
            <button class="btn btn-primary btn-m" type="button" class="nav-link" data-toggle="modal" data-target="#tambahPemakaian">
              Tambah Pemakaian<span class="glyphicon glyphicon-plus-sign"></span> 
            </button>
          </div>
 -->
        </div>
      </div>


      <div class="tab-pane" id="tambah_pemakaian">
        <div id='progress'><div id='progress-complete'></div></div>

        <form id="SignupForm" action="{{url('pemakaianadmin/tambah')}}" method="post">
          {{ csrf_field()}}
          <fieldset>
            <legend>Tambah pemakaian</legend>
            <div class="form-group">
              <label>Pilih Ruangan</label>
              <select name="ruangan" id="ruanganinput" class="form-control" autofocus>
                @foreach($data['ruangan'] as $ruangan)
                <option value="{{$ruangan['id']}}">{{$ruangan['nama_ruangan']}}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Kapasitas Ruangan&nbsp;{{$ruangan['kapasitas_ruangan']}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Tanggal Peminjaman</label>
              <div class="input-group date" id="datetimepicker">
                <input type="date" class   ="form-control date" name="tanggal_peminjaman" value="{{ old('waktu_peminjaman') }}"  id="tanggalinput">
                <span class="input-group-addon" id="datepicker">
                </span> 
              </div>
              <div class="form-group">
                <label> Waktu Mulai (hh:mm am/pm) </label>
                <input type="time" id="waktu_mulai" class="form-control time" name="waktu_mulai">
              </div>

              <div class="form-group">
               <label> Waktu Selesai (hh:mm am/pm) </label>
               <input type="time" id="waktu_selesai" class="form-control time" name="waktu_selesai">
             </div>
           </fieldset>


           <fieldset>
            <legend>Tambah pemakaian</legend>
            <div class="form-group">
             <label>Jenis Kegiatan</label>
             <select name="jenis_kegiatan" class="form-control" autofocus>
              @foreach($data['kegiatan'] as $kegiatan)
              <option value="{{$kegiatan['id']}}">{{$kegiatan['jenis_kegiatan']}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
           <label> Deskripsi Kegiatan </label>
           <input type="text" name="deskripsi" placeholder="Tambah Deskripsi" class="form-control" rows="8" required>
         </div>
         <div class="form-group">
           <label>Biaya Tambahan</label>
           <input readonly="0" type="read" name="biaya" placeholder="0" class="form-control" rows="8">
         </div>
       </fieldset>
       <button id="SaveAccount" type="submit" class="btn btn-primary submit">Submit form</button>
     </form>
   </div>


   <div class="tab-pane" id="data_pemakaian">
    <legend>Ruangan yang sedang digunakan</legend>
    <div class="table-responsive">
      <table id="example1lagi" class="table table-bordered table-striped">
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
        <tbody id="informasi" name="informasi">
          <?php $number=0 ?> 
          @foreach($data['pemakaianall'] as $pemakaian)
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


<!-- ================================================================= -->

<!-- Tambah Pemakaian -->
<div class="modal fade" id="tambahPemakaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="card-header">
          <label>Tambah Pemakaian</label>
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
                 <form role="form" method="POST" action="{{url('pemakaianadmin/tambah')}}">
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
                    <label>Tanggal Peminjaman</label>
                    <div class="input-group date" id="datetimepicker">
                      <input type="date" class="form-control date" name="tanggal_peminjaman" value="{{ old('waktu_peminjaman') }}"  id="datepicker">
                      <span class="input-group-addon" id="datepicker">
                      </span>     
                    </div>
                  </div>
                  <div class="col-sm-12">
                   <!--  <div class="bootstrap-timepicker"> -->
                    <label> Waktu Mulai (hh:mm am/pm) </label>
                    <input type="time" class="form-control time" name="waktu_mulai">
                    <!-- </div> -->
                  </div>
                  <div class="col-sm-12">
                    <!-- <div class="bootstrap-timepicker"> -->
                      <label> Waktu Selesai (hh:mm am/pm) </label>
                      <input type="time" class="form-control time" name="waktu_selesai">
                      <!-- </div> -->
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
                      <input type="text" name="deskripsi" placeholder="Tambah Deskripsi" class="form-control" rows="8">
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
  <div id="alertError"></div> <!-- alert bentrok -->

  <!-- Modal Edit -->
  @foreach($data['pemakaian'] as $pemakaian)
  <div class="modal fade" id="ModalEdit{{$pemakaian->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="card-header">
            <label>Edit Pemakaian</label>
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
                   <form role="form" method="POST" action="{{url('/pemakaianadmin/'.$pemakaian->id)}}">
                    {{ method_field('PUT')}}
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
                      <label>Tanggal Peminjaman</label>

                      <div class="input-group date" id="datetimepicker">
                        <input type="date" class   ="form-control date" name="tanggal_peminjaman" value="{{date('m/d/Y',strtotime($pemakaian->tanggal_mulai))}}"  id="datepicker">
                        <span class="input-group-addon" id="datepicker">
                        </span>     
                      </div>
                    </div>
                    <div class="col-sm-12">
                     <!--  <div class="bootstrap-timepicker"> -->
                      <label> Waktu Mulai </label>
                      <input type="time" class="form-control time" name="waktu_mulai">
                      <!-- </div> -->
                    </div>
                    <div class="col-sm-12">
                      <!-- <div class="bootstrap-timepicker"> -->
                        <label> Waktu Selesai </label>
                        <input type="time" class="form-control time" name="waktu_selesai">
                        <!-- </div> --> 
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
                        <input type="text" name="deskripsi" value="{{$pemakaian->deskripsi}}" class="form-control" rows="8">
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

    <!-- Modal Detail -->
    @foreach($data['pemakaian'] as $pemakaian)
    <div class="modal fade" id="ModalDetail{{$pemakaian->id}}">
      <div class="modal-dialog" role="document">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="card-header">
                <label>Detail Pemakaian</label>
              </div>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <tbody>
                <div style="margin-left: 15px">
                  <p>Nama ruangan     : {{$pemakaian['nama_ruangan']}}</p>
                  <p>Tanggal          : {{date("d-m-Y",strtotime($pemakaian['tanggal_mulai']))}}</p>
                  <p>Waktu Mulai      : {{date("H:i",strtotime($pemakaian['tanggal_mulai']))}}</p>
                  <p>Waktu Selesai    : {{date("H:i",strtotime($pemakaian['tanggal_selesai']))}}</p>
                  <p>Jenis kegiatan   : {{$pemakaian['jenis_kegiatan']}}</p>
                  <p>Deskripsi        : {{$pemakaian['deskripsi']}}</p>
                  <p>Status           :
                   @if($pemakaian->status==0)
                   Menunggu
                   @elseif($pemakaian->status==1)
                   Diterima
                   @else
                   Ditolak
                   @endif
                 </p>
               </div>
             </tbody>
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

<!-- <script>
  $(function () {
    $('#example3').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script> -->

<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
</script>

<script>
  $("button").click(function(){
    $.ajax({url: "/pemakaianadmin", success: function(result){
      $("#div1").html(result);
    }});
  });
</script>

</body>
</html>

@endsection