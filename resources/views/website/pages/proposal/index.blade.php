@extends('website.layouts.main')

@section('title', 'List Proposal')

@section('page')
<div class="col-md-12 my-3">
  <!-- jquery validation -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title"><strong>List Proposal</strong></h3>
      <a href="{{ route('website.proposal.create') }}" class="float-right btn btn-sm btn-light border"><i class="fas fa-plus"></i> Tambah Data</a>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table id="table" class="table table-stripped table-bordered" width="100%">
              <thead class="bg-light">
                <tr class="text-center">
                  <th width="5%">No</th>
                  <th>Judul Proposal</th>
                  <th>Instansi</th>
                  <th>Alamat</th>
                  <th>Penanggung Jawab</th>
                  <th>Pembawa</th>
                  <th>Nomor</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>

      <!-- /.card-body -->

    </div>
    <!-- /.card -->
  </div>
  <!--/.col (left) -->
</div>
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('vendor/plugins/datatables/jquery.dataTables.min.js') }}" ></script>
<script src="{{ asset('vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" ></script>
<script type="text/javascript">
  $(document).ready( function() {

    @if(Session::get('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif

    var table = $('#table').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      searching : true,
      bLengthChange : false,

      "ajax" : {
        "url": "{{ route('website.proposal.ajax_index') }}",
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
        "data" : "judul",
        "name" : "judul",
        orderable: false,
      },
      {
        "data" : "nama_instansi",
        "name" : "nama_instansi",
        orderable: false,
      },
      {
        "data" : "alamat_instansi",
        "name" : "alamat_instansi",
        orderable: false,
      },
      {
        "data" : "penanggungjawab_instansi",
        "name" : "penanggungjawab_instansi",
        orderable: false,
      },
      {
        "data" : "pembawa",
        "name" : "pembawa",
        orderable: false,
      },
      {
        "data" : "nomor_proposal",
        "name" : "nomor_proposal",
        orderable: false,
      },
      ]
    });
    
  });
</script>
@endpush