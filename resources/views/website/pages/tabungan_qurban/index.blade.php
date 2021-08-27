@extends('website.layouts.main')

@section('title', 'Tabungan Qurban')

@section('page')
<div class="col-md-12 my-3">
	<!-- jquery validation -->
	<div class="card card-light ">
		<div class="card-header">
			<h3 class="card-title"><strong>Tabungan Qurban</strong></h3>
		</div>
		<div class="card-body">
			<p class="lead">Data Tabungan Qurban Anda</p>
			<div class="form">
				<div class="form-group row">
					<label class="col-sm-3 col-form-label text-right">Nama Karyawan</label>
					<div class="col-sm-9 bg-light pt-1">
						{{ $data->name}}
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label text-right">NPK</label>
					<div class="col-sm-9 bg-light pt-1">
						{{ $data->npk}}
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label text-right">Departemen</label>
					<div class="col-sm-9 bg-light pt-1">
						
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label text-right">Rencana Mulai</label>
					<div class="col-sm-9 bg-light pt-1">
						
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label text-right">Jangka Waktu Tabungan</label>
					<div class="col-sm-9 bg-light pt-1">
						
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 col-form-label text-right">Jumlah Tabungan Saat ini</label>
					<div class="col-sm-9 bg-light pt-1">
						
					</div>
				</div>
				
			</div>
		</div>
		<div class="card-footer">
			<a href="#" class="btn btn-default border"><i class="fas fa-search"></i> Lihat Detail Bulanan</a>
		</div>
	</div>
</div>
@endsection