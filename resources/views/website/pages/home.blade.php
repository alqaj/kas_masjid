@extends('website.layouts.main')

@section('title', 'Beranda')

@section('page')
<div class="col-md-12 my-3">
	<!-- jquery validation -->
	<div class="card card-default">
		<div class="card-header">
			<h3 class="card-title"><strong>Beranda</strong></h3>
		</div>
		<div class="card-body">
			<p class="lead">Selamat datang di Aplikasi Kas Masjid Online</p>
			<div class="form">
				<div class="form-group row">
					<label class="col-sm-2 col-form">Nama Organisasi</label>
					<div class="col-sm-9">
						{{ $data->company_name }}
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-labe">Alamat Organisasi</label>
					<div class="col-sm-9">
						{{ $data->address }}
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-labe">No Telefon</label>
					<div class="col-sm-9">
						{{ $data->telp }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection