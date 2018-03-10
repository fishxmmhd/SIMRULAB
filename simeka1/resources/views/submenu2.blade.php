@extends('layouts.app')

@section('htmlheader_title')
	Submenu
@endsection


@section('main-content')
	<!-- Example DataTables Card-->
     <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Formulir Peminjaman Ruangan</div>
                <div class="card-body">
                    <form role="form" method="POST" action="add_tugas">
                         <div class="col-sm-12">
                            <label>Pilih Ruangan</label>
                                <select name="ruangan" class="form-control" autofocus>
                                <option value="{{ old('ruangan') }}" selected>{{ old('ruangan') }}</option>
                                </select>
                        </div>
                        <div class="col-sm-12">
                            <label>Informasi Ruangan</label>
                            <input class="form-control" placeholder="" name= "nama_ruangan" value="{{ old('nama_ruangan') }}" autofocus>
                        </div>
                         <div class="col-sm-12">
                            <label>Nama Kegiatan</label>
                            <input class="form-control" placeholder="" name= "nama_kegiatan" value="{{ old('nama_kegiatan') }}" autofocus>
                        </div>
                        <div class="col-sm-12">
                            <label> Deskripsi Kegiatan </label>
                            <textarea name="deskripsi" value="" class = "form-control" rows="8"autofocus></textarea>
                        </div>
                        <div class="col-sm-12">
                            <label>Waktu Peminjaman</label>
                            <div class="input-group date" id="datetimepicker">
                                <input type="date" class="form-control date" name="waktu_peminjaman" value="{{ old('waktu_peminjaman') }}" id="datepicker">
                                <span class="input-group-addon" id="datepicker">
                                </span>     
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            <button type="reset" class="btn btn-danger pull-right" style="margin-right: 10px;">Reset</button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>    
        </div>
    </div>
@endsection
