@extends('website.layouts.main')

@section('title', 'Laporan')

@section('page')
<div class="col-md-12 my-3">
  <!-- jquery validation -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title"><strong>Laporan Kas Bulan Ini</strong></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <!-- .card-body -->
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6 p-2">
          <canvas id="saldo-chart" height="150"></canvas>
        </div>
        <div class="col-lg-6 p-1">
          <table class="table table-bordered table-sm">
            <thead>
              <tr class="text-center bg-light">
                <th>No</th>
                <th>Jenis Akun</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Saldo Bulan Lalu</td>
                <td>{{ number_format($saldo,0,",",".") }}</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Pemasukan Tetap</td>
                <td>{{ number_format($source->Pemasukan_Tetap,0,",",".") }}</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Pemasukan Tidak Tetap</td>
                <td>{{ number_format($source->Pemasukan_Tidak_Tetap,0,",",".") }}</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Pengeluaran Tetap</td>
                <td>- {{ number_format($source->Pengeluaran_Tetap,0,",",".") }}</td>
              </tr>
              <tr>
                <td>5</td>
                <td>Pengeluaran Tidak Tetap</td>
                <td>- {{ number_format($source->Pengeluaran_Tidak_Tetap,0,",",".") }}</td>
              </tr>
            </tbody>
            <tfoot>
              @php
              $final_saldo = $saldo + $source->Pemasukan_Tetap + $source->Pemasukan_Tidak_Tetap - $source->Pengeluaran_Tetap - $source->Pengeluaran_Tidak_Tetap;
              @endphp
              <tr>
                <th colspan="2">Total</th>
                <th>{{ number_format($final_saldo, 0, ",", ".") }}</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!--/.col (left) -->
@endsection

@push('styles')


@endpush
@push('scripts')
<script src="{{ asset('vendor/plugins/chart.js/Chart.min.js') }}"></script>

<script type="text/javascript">
 $(function () {

  $.ajax({
    url: "{{ route('website.kas.ajax_show_grup_report') }}",
   method: "GET",
   success: function(data) {
     console.log(data);
     var label = [];
     var value = [];
     var color=[];
     for (var i in data) {
       value.push(data[i].value);
       label.push(data[i].label);
       color.push(data[i].color);
     }
     var ctx = document.getElementById('saldo-chart').getContext('2d');
     var chart = new Chart(ctx, {
       type: 'bar',
       data: {
         labels: label,
         datasets: [{
           label: 'Laporan Saldo Bulan Ini',
           // backgroundColor: 'rgb(237, 168, 19)',
           borderColor: 'rgb(255, 255, 255)',
           backgroundColor: color,
           data: value
         }]
       },
       options: {}
     });
   }
 });
});
</script>
@endpush