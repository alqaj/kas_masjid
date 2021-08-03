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
			<div>
				<div class="form-group row">
					<label for="filter" class="col-sm-2 col-form-label">Periode</label>
					<div class="col-sm-10">
						<select class="form-control" name="filter"style="width: 100%;" id="filter">
							<option value="minggu" selected="selected">Minggu Ini</option>
							<option value="bulan">Bulan Ini</option>
						</select>
					</div>
					<hr/>
				</div>
			</div>

			<table class="table table-stipped table-sm" id="table" width="100%">
				<thead class="bg-light">
					<tr>
						<th width="5%">No</th>
						<th width="20%">Nama Akun</th>
						<th width="15%">Tanggal Mutasi</th>
						<th width="30%">Jumlah Mutasi</th>
						<th width="30%">Saldo</th>
								</tr>
				</thead>
				<tbody></tbody>
				<tfoot class="bg-secondaary">
					<tr>
						<th colspan="3">Total</th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('vendor/plugins/datatables/jquery.dataTables.min.js') }}" ></script>
<script src="{{ asset('vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" ></script>
<script type="text/javascript">
	$(function () {
		
		var table = $('#table').DataTable({
		  responsive: true,
		  processing: true,
		  serverSide: true,
		  searching : false,
		  bLengthChange : false,
		  "ajax" : {
		    "url": "{{ route('website.kas.ajax_show') }}",
		    "data" : {
		      filter : function(){
		        return $('#filter').val();
		      }
		    },
		  },
		  "columns" : [
		  {
		    data: null,
		    name: 'no',
		    orderable: false,
		    searchable: false,
		    render: function (data, type, row, meta) {
		      return meta.row + meta.settings._iDisplayStart + 1;
		    }
		  },
		  {
		    "data" : "nama_akun",
		    "name" : "nama_akun",
		    orderable: false,
		    searchable: false,
		  },
		  {
		    "data" : "tanggal_mutasi",
		    "name" : "tanggal_mutasi",
		    orderable: false,
		    searchable: false,
		  },
		  {
		    "data" : "jumlah",
		    "name" : "jumlah",
		    orderable: false,
		    searchable: false,
		  },
		  {
		    "data" : "saldo",
		    "name" : "saldo",
		    orderable: false,
		    searchable: false,
		  },
		  ]
		});

		$('#filter').on('change', function(){
			table.ajax.reload();
		});
	});
</script>
@endpush