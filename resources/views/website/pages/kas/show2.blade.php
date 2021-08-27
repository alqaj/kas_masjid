@extends('website.layouts.main')

@section('title', 'Lihat Kas')

@section('page')
<div class="col-md-12 my-3">
	<!-- jquery validation -->
	<div class="card card-default">
		<div class="card-header">
			<h3 class="card-title"><strong>Lihat Kas</strong></h3>
		</div>
		<div class="card-body">
			@if(count($view_data) > 0)
			<table class="table table-stipped" id="table" width="100%">
				<thead class="bg-light">
					<tr>
						<th colspan="4">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<select class="custom-select custom-select-md" id="filter" name="filter" aria-label="Example select with button addon">
											<option value="" selected="selected" disabled="">Periode..</option>
											<option value="minggu">Minggu Ini</option>
											<option value="bulan">Bulan Ini</option>
										</select>
										<div class="input-group-append">
											<button class="btn-search btn btn-light border" type="button"><i class="fas fa-search"></i> Cari</button>
										</div>
									</div>
								</div>
							</div>
						</th>
					</tr>
					<tr>
						<th width="45%">Nama Akun</th>
						<th width="25%">Tanggal Mutasi</th>
						<th width="15%">Jumlah Mutasi</th>
						<th width="15%">Saldo</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						@if($filter=="bulan")
						<td colspan="3">Sisa Saldo Bulan Lalu</td>
						@else
						<td colspan="3">Sisa Saldo Minggu Lalu</td>
						@endif
						<td>{{ number_format($last_saldo,0,".",",") }}</td>
					</tr>
					@foreach($view_data as $d)
					<tr>
						<td>{{ $d['nama_akun'] }}</td>
						<td>{{ $d['tanggal_mutasi'] }}</td>
						<td>{{ number_format($d['jumlah'],0,".",",") }}</td>
						<td>{{ number_format($d['saldo'],0,".",",") }}</td>
						@php $saldo_end = $d['saldo'] @endphp
					</tr>
					@endforeach
				</tbody>
				<tfoot class="bg-secondaary">
					<tr>
						<th colspan="3">Saldo Akhir</th>
						<th>{{ number_format($saldo_end,0,".",",") }}</th>
					</tr>
					<tr>
						<th colspan="4">
							<a href="{{ route('website.kas.report') }}" class="float-right btn btn-light border" target="_blank"><i class="fas fa-print"></i> Cetak Laporan Bulanan</a>
						</th>
					</tr>
				</tfoot>
			</table>
			@else
			<table class="table table-stipped" id="table" width="100%">
				<thead class="bg-light">
					<tr>
						<th colspan="4">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<select class="custom-select custom-select-md" id="filter" name="filter" aria-label="Example select with button addon">
											<option value="" selected="selected" disabled="">Periode..</option>
											<option value="minggu">Minggu Ini</option>
											<option value="bulan">Bulan Ini</option>
										</select>
										<div class="input-group-append">
											<button class="btn-search btn btn-light border" type="button"><i class="fas fa-search"></i> Cari</button>
										</div>
									</div>
								</div>
							</div>
						</th>
					</tr>
					<tr>
						<th width="45%">Nama Akun</th>
						<th width="25%">Tanggal Mutasi</th>
						<th width="15%">Jumlah Mutasi</th>
						<th width="15%">Saldo</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						@if($filter=="bulan")
						<td colspan="3">Sisa Saldo Bulan Lalu</td>
						@else
						<td colspan="3">Sisa Saldo Minggu Lalu</td>
						@endif
						<td>{{ number_format($last_saldo,0,".",",") }}</td>
					</tr>
				</tbody>
				<tfoot class="bg-secondaary">
					<tr>
						<th colspan="3">Saldo Akhir</th>
						<th>{{ number_format($last_saldo,0,".",",") }}</th>
					</tr>
					<tr>
						<th colspan="4">
							<a href="{{ route('website.kas.report') }}" class="float-right btn btn-light border" target="_blank"><i class="fas fa-print"></i> Cetak Laporan Bulanan</a>
						</th>
					</tr>
				</tfoot>
			</table>
			@endif
		</div>
	</div>
</div>
@endsection

@push('styles')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"> -->
@endpush

@push('scripts')
<!-- <script src="{{ asset('vendor/plugins/datatables/jquery.dataTables.min.js') }}" ></script>
	<script src="{{ asset('vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" ></script> -->
	<script type="text/javascript">
		$(function () {
			$('.btn-search').on('click', function(){
				if($('#filter').val()==null)
				{
					alert('Pilih Periode Dahulu');
				}
				else
				{
					var url = "{{ route('website.kas.show_history') }}";
					window.location.href= url + '?filter=' + $('#filter').val();
				}
			});
		});
	</script>
	@endpush