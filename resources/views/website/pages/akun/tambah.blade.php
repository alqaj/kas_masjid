@extends('website.layouts.main')

@section('title', 'Input Akun Baru')

@section('page')
<div class="col-md-12 my-3">
  <!-- jquery validation -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title"><strong>Input Akun</strong></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="quickForm" action="{{ route('website.akun.simpan') }}" method="post">
      <div class="card-body">
        @csrf

        <div class="form-group row">
          <label for="jenis_akun" class="col-sm-2 col-form-label">Jenis Akun</label>
          <div class="col-sm-10">
            <select class="form-control" name="jenis_akun"style="width: 100%;" id="jenis_akun">
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
          <label for="nama_akun" class="col-sm-2 col-form-label">Nama Akun</label>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control" id="nama_akun" name="nama_akun" placeholder="Masukkan Nama Akun">
            @error('nama_akun')
            <span class="text-danger">{{ $message }}</span>
            @enderror
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

@push('scripts')
<script type="text/javascript">
  @if(Session::get('success'))
    toastr.success("{{ Session::get('success') }}");
  @endif
</script>
@endpush