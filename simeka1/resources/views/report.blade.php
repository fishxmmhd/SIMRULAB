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

            <div action="{{ url('home.excelpemakaianadmin') }}" class="btn btn-primary"><i class="fa fa-download"></i><strong> Laporan Pemakaian Bulanan.xls</strong></div>
  
    </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>

@endsection