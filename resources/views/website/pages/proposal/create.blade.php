@extends('website.layouts.main')

@section('title', 'Input Master Proposal')

@section('page')
<div class="col-md-12 my-3">

  <!-- jquery validation -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title"><strong>Input Master Proposal</strong></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if(Session::get('success'))
    <div class="card-body">
      <h4 class="text-center">Proposal baru telah terdaftar. No Proposal:</h4>
      <h3 class="myinput text-center font-weight-bold"> {{ Session::get('success') }}</h3>
      <br>
      <div class="tool-tip">
        <center>
          <button class="btn btn-light border btn-copy" data-toggle="tooltip" data-placement="top" title="Copy to Clipboard">
            <i class="fas fa-copy"></i> Copy to Clipboard
          </button>
          <br/>
          <br/>
          <span class="info bg-info p-1" hidden="hidden">Copied!</span>
        </center>
      </div>
    </div>
    <footer class="card-footer">
      <a class="btn btn-primary" href="{{ route('website.proposal.create') }}">Input Proposal Baru</a>
    </footer>
    @else
    <form id="quickForm" action="{{ route('website.proposal.store') }}" method="post">
      <div class="card-body">
        @csrf      

        <div class="form-group row">
          <label for="judul" class="col-sm-2 col-form-label">Judul Proposal*</label>
          <div class="col-sm-10">
            <input type="text" name="judul" class="form-control form-control-sm" required="" id="judul">
            @error('judul')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="nama_instansi" class="col-sm-2 col-form-label">Nama Instansi*</label>
          <div class="col-sm-10">
            <input type="text" name="nama_instansi" class="form-control form-control-sm" required="" id="nama_instansi">
            @error('nama_instansi')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="alamat_instansi" class="col-sm-2 col-form-label">Alamat Instansi (Kota)*</label>
          <div class="col-sm-10">
            <input type="text" name="alamat_instansi" class="form-control form-control-sm" required="" id="alamat_instansi">
            @error('alamat_instansi')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="penanggungjawab_instansi" class="col-sm-2 col-form-label">Penannggung Jawab Instansi*</label>
          <div class="col-sm-10">
            <input type="text" name="penanggungjawab_instansi" class="form-control form-control-sm" required="" id="penanggungjawab_instansi">
            @error('penanggungjawab_instansi')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="alamat_instansi" class="col-sm-2 col-form-label">Pembawa*</label>
          <div class="col-sm-10">
            <input type="text" name="pembawa" class="form-control form-control-sm" required="" id="pembawa">
            @error('pembawa')
            <span class="text-danger">{{ $message }}</span>
            @enderror
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
    @endif
  </div>
  <!-- /.card -->
</div>
<!--/.col (left) -->
@endsection

@push('styles')
<style type="text/css">

</style>
@endpush
@push('scripts')

<script type="text/javascript">
 $(document).ready( function() {

  @if(Session::get('success'))
  toastr.success("Sukses menyimpan data!");
  @endif

  $('.btn-copy').on('click', function(){
    var copyText = $('.myinput').html();
    navigator.clipboard.writeText(copyText);

    $('.info').removeAttr('hidden');

  });

  });
</script>
@endpush