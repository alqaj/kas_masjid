@extends('website.layouts.main')

@section('title', 'Input Kas')

@section('page')
<div class="col-md-12 my-3">
  <!-- jquery validation -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title"><strong>Input Mutasi Kas</strong></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="quickForm" action="{{ route('website.kas.simpan') }}" method="post">
      <div class="card-body">
        @csrf

        <div class="form-group row">
          <label for="jenis_akun" class="col-sm-2 col-form-label">Jenis Akun*</label>
          <div class="col-sm-10">
            <select class="form-control select2" name="jenis_akun"style="width: 100%;" id="jenis_akun" data-none-selected-text="Pilih Jenis Akun">
              <option selected="selected" value="" disabled=""> Pilih </option>
              <option value="out">Pengeluaran</option>
              <option value="in">Pemasukan</option>
            </select>
            @error('jenis_akun')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

        </div>

        <div class="form-group row">
          <label for="nama_akun" class="col-sm-2 col-form-label">Nama Akun*</label>
          <div class="col-sm-10">
            <select class="form-control select2" style="width: 100%;" name="nama_akun" id="nama_akun" data-live-search="true" data-none-selected-text="Pilih Nama Akun">
            </select>
            @error('nama_akun')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

        </div>

        <div class="form-group row">
          <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Mutasi*</label>
          <div class="col-sm-10">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <!-- <input type="date" class="form-control" data-inputmask-alias="datetime" name="tanggal_mutasi"> -->
              <input type="text" class="datepicker form-control" data-inputmask-alias="datetime" data-date-format="yyyy-mm-dd" name="tanggal_mutasi">
            </div>
            @error('tanggal_mutasi')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Jumlah*</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah">
            @error('jumlah')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="" class="col-sm-2 col-form-label">Catatan Detail</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="note" id="note"></textarea>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-12">
            <p>*) : Wajib diisi</p>
          </div>
        </div>

      </div>
      <!-- /.card-body -->
      <div class="card-footer text-center">
        <button type="submit" class="btn btn-default"> Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
      </div>
    </form>
  </div>
  <!-- /.card -->
</div>
<!--/.col (left) -->
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/plugins/select-picker/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

@endpush
@push('scripts')
<script src="{{ asset('vendor/plugins/select-picker/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
 $(function () {
    //Initialize Select2 Elements
    $('.select2').selectpicker();
    $('.datepicker').datepicker();

    @if(Session::get('success'))
       toastr.success("{{ Session::get('success') }}");
    @endif

    $('#jenis_akun').on('change', function(){
      var type = $(this).val();
       $.ajax({
            url: "{{ route('website.kas.ajax_akun') }}",
            type: 'get',
            data: {
              'type' : type,
            },
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#nama_akun").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['nama_akun'];
                    
                    $("#nama_akun").append("<option value='"+id+"'>"+name+"</option>");
                }
                $('.select2').selectpicker('refresh');
            }
        });
    });
    
  });
</script>
@endpush