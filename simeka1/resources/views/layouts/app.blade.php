<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
@include('layouts.partials.htmlheader')
@show

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.partials.mainheader')

        @if(Auth::user()->role==2)
        @include('layouts.partials.sidebar')
        @else
        @include('layouts.partials.sidebaruser')
        @endif


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                @yield('main-content')
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->


        @include('layouts.partials.footer')

    </div><!-- ./wrapper -->

    @section('scripts')<!-- 
    @include('layouts.partials.scripts') -->
    <script>
      $('#rekapdata').change(function(){
        var ruangan = document.getElementById('rekapdata').value
        console.log(ruangan)
        var url = "/status/rekap/"+ ruangan
        $.ajax({url: url}).done(function(result){
          var data = result.data
          var htmlData = ''
          for(var i=0; i<data['pemakaian'].length; i++){
            htmlData += 
                '<tr>'+
                '<td>'+ (i+1) +'</td>'+
                '<td>'+ data['pemakaian'][i].tanggal_mulai +'</td>'+
                '<td>'+ data['pemakaian'][i].tanggal_mulai +'</td>'+
                '<td>'+ data['pemakaian'][i].tanggal_selesai +'</td>'+
                '<td>'+ data['ruangan'][i].nama_ruangan +'</td>'+
                '<td>'+ data['pemakaian'][i].jenis_kegiatan +'</td>'+
                '<td>'+ data['user'][i].name +'</td>'+
                '<td>'+ data['pemakaian'][i].deskripsi +'</td>'
           if(data['pemakaian'][i].status == 1){
              htmlData += '<td>Diterima</td>'
           }else{
              htmlData += '<td>Ditolak</td><td>'+
                          '<form action="status/'+ data['pemakaian'][i].id +'" method="put">' + 
                            '<input type="submit" name="status" value="Diterima" class="btn btn-success btn-sm">' +
                            '<input type="submit" name="status" value="Ditolak" class="btn btn-warning btn-sm">'+
                           '</form></td>'
           }
           htmlData += '</tr>'
          }
          console.log(data['pemakaian'])
          document.getElementById('pemakaian-info').innerHtml = htmlData
        })
      })  
    </script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                'csv', 'excel', 'pdf'
                ]
            } );
        } );
    </script>

    <script>
        $(document).ready(function() {
            $('#example1lagi').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>

    @show

</body>
</html>
