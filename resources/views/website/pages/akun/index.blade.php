@extends('website.layouts.main')

@section('title', 'List Akun')

@section('page')
<div class="col-md-12 my-3">
  <!-- jquery validation -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title"><strong>List Akun</strong></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 btn-group mb-2" role="group">
          <button class="btn btn-menu btn-light border text-dark" data-val="in">Pemasukan</button>
          <button class="btn btn-outline-light border text-dark btn-menu" data-val="out">Pengeluaran</button>
        </div>
        <input type="hidden" id="jenis_akun" value="in">
        <div class="col-md-12">
          <div class="table-responsives">
            <table id="table" class="table table-stripped table-bordered" width="100%">
              <thead class="bg-light">
                <tr>
                  <th colspan="2">
                    <div class="input-group mb-1">
                      <div class="input-group-prepend">
                      </div>
                      <input type="text" name="filter" id="filter" class="form-control" placeholder="Cari Data...">
                      <div class="input-group-append">
                        <button class="btn btn-light border btn-cari"><i class="fas fa-search"></i> Cari</button>
                        <a href="{{route('website.akun.tambah') }}" class="btn btn-light border" type="button">
                          <i class="fas fa-plus"></i> Input Baru
                        </a>
                      </div>
                    </div>
                  </th>
                </tr>
                <tr class="text-center">
                  <th width="5%">No</th>
                  <th>Nama Akun</th>
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
      searching : false,
      bLengthChange : false,
      "ajax" : {
        "url": "{{ route('website.akun.ajax_index') }}",
        "data" : {
          jenis_akun : function() {
            var jenis_akun = CariJenisAkun();
            return jenis_akun;
          },
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
      ]
    });  

    $('.btn-menu').click(function() {

      $('.btn-menu').removeClass('btn-light');
      $('.btn-menu').addClass('btn-outline-light');
      $(this).removeClass('btn-outline-light');
      $(this).addClass('btn-light');

      $('#jenis_akun').val($(this).data('val'));

      table.ajax.reload();
    });

    function CariJenisAkun(){
      return $('#jenis_akun').val();
    }

    // $('#filter').on('keyup', function() {
    //   table.ajax.reload();
    // });
    $('.btn-cari').on('click', function() {
      table.ajax.reload();
    });

  })
</script>
@endpush