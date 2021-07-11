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
					<label for="periode" class="col-sm-2 col-form-label">Periode</label>
					<div class="col-sm-10">
						<select class="form-control" name="periode"style="width: 100%;" id="periode">
							<option selected="selected" value="" disabled=""> Pilih </option>
							<option value="out">Minggu Ini</option>
							<option value="in">Bulan Ini</option>
							<option value="in">Tahun Ini</option>
						</select>
					</div>
					<hr/>
				</div>
			</div>

			<table class="table table-stipped table-bordered table-sm">
				<thead class="bg-secondaray">
					<tr>
						<th width="5%">No</th>
						<th width="20%">Nama Akun</th>
						<th width="15%">Tanggal Mutasi</th>
						<th width="30%">In</th>
						<th width="30%">Out</th>
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