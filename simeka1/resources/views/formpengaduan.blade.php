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
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
	width: 100%;
	padding: 12px;
	border: 1px solid #ccc;
	border-radius: 4px;
	box-sizing: border-box;
	margin-top: 6px;
	margin-bottom: 16px;
	resize: vertical;
}

input[type=submit] {
	background-color: #4CAF50;
	color: white;
	padding: 12px 20px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
}

input[type=submit]:hover {
	background-color: #45a049;
}

.container {
	border-radius: 5px;
	background-color: #f2f2f2;
	padding: 20px;
}
</style>

<body>

	<section class="content">
		<div class="row">
			<div class="box">
				<div class="box-header">
					<div class="container-fluid">


						<legend>Formulir Pengaduan</legend>

						

						<form action="{{url('formpengaduan/$pemakaian->id')}}" method="post">
							{{ csrf_field()}}
							<div class="form-group">
								<label>Pilih Pemakaian</label>
								<select name="pilih_pemakaian" class="form-control" autofocus>
									@foreach($data['pemakaian'] as $pemakaian)
									<option value="{{$pemakaian['id']}}">{{$pemakaian['nama_ruangan']}}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Tanggal Pemakaian:&nbsp;{{date("d-m-Y",strtotime($pemakaian['tanggal_mulai']))}}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Tanggal Mulai&nbsp;{{date("H:i",strtotime($pemakaian['tanggal_mulai']))}}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Tanggal Selesai&nbsp;{{date("H:i",strtotime($pemakaian['tanggal_selesai']))}}</option>
									@endforeach
								</select>
							</div>
							<label for="isi_pengaduan">Isi:</label>
							<textarea class="form-control" rows="5" id="isi_pengaduan"></textarea>
							<!-- <label for="isi_pengaduan">Isi</label>
							<textarea id="isi_pengaduan" name="isi_pengaduan" placeholder="Write something.." style="height:200px"></textarea>
 -->
							<input type="submit" value="Submit">
						</form>
					</div>


				</body>
				@endsection