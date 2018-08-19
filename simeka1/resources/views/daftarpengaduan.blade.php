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


						<legend>Daftar Pengaduan</legend>
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
									<th>Pemakai</th>
									<th>Isi Pengaduan</th>
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
									<td>{{$pemakaian['name']}}</td>
									<td>
										<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ModalDetail{{$pemakaian->id}}">
											<strong>DETAIL</strong>
										</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

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
										<p>Pemakai       	: {{$pemakaian['name']}}</p>
										<p>Isi Pengaduan    :
											@if(isset($pemakaian->pengaduan->isi_pengaduan))
											<td>{{$pemakaian->pengaduan->isi_pengaduan}}</td>
											@else
											<td>Tidak ada pengaduan</td>
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




		</body>
		@endsection