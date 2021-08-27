 <head>
 	<title>Laporan Keuangan</title>
 </head>
 <body>
 	<style type="text/css">
   @page { 
    margin: 40px;
    margin-top : 20px;
}
.title {
    font-family: 'Tahoma';
    font-size: 14pt;
    margin: 5px;
}
.sub-title {
    font-family: 'Tahoma';
    font-size: 13pt;
    margin: 5px;
}
body {
    font-size: 10pt;
    /*font-family: 'sans-serif';*/
}
.table {
    border-collapse: collapse;
}

.paragraf {
    font-family: 'Arial' !important ;
    font-size: 12pt;
}
th {
    text-align: center;
    font-weight: bold;
    border: 1px solid #000;
    padding: 3px;
    /*vertical-align: center;*/
}
td {
    border: 1px solid #000;
    /*border-bottom: 1px  #000;*/
    /*border-top: 1px  #000;*/
    padding: 2px;
    padding-left: 5px; 
    /*text-align: left;*/
}
/*p { margin-bottom: 5px; }*/

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

.font-bold {
    font-weight: bold;
}

.sign {
    /*height: 10px;*/
    padding-top: 50px;
}

.no-page-break {
    display: inline-block;
    width: 100%;
    page-break-inside: avoid;
}
</style>

<p class="text-center title"><b>{{ Auth::user()->company->company_name }}</b></p>
<p class="text-center sub-title"><b>{{ Auth::user()->company->address }}</b></p>
<p class="text-center sub-title"><b>Telefon: {{ Auth::user()->company->telp }}</b></p>
<hr/>
<br/>
<p class="text-center title"><b>LAPORAN KEUANGAN</b></p>
<p class="text-center sub-title"><b>Periode: {{ $first_date_of_the_month }} s/d {{ $end_date_of_the_month }} </b></p>
<br><br>
<p class="text-center sub-title">Assalaamu'alaikum Warahmatullaahi Wabarakaatuh</p>
<p class="paragraf">Alhamdulillah, Puji dan Syukur kami panjatkan ke hadirat Allah SWT, yang telah memberikan kami kesempatan untuk menyelesaikan Laporan Keuangan Bulanan Masjid. Laporan ini adalah salah bentuk transparansi terhadap amanah yang sudah di berikan kepada DKM. Semoga Allah selalu memberkahi kita semua.</p>

<table width="100%" class="table paragraf">
   <tr>
    <th>No</th>
    <th>Jenis Akun</th>
    <th>Jumlah</th>
</tr>
<tr>
    <td class="text-center">1</td>
    <td>Saldo Bulan Lalu</td>
    <td class="text-right">{{ number_format($saldo,0,",",".") }}</td>
</tr>
<tr>
    <td class="text-center">2</td>
    <td>Pemasukan Tetap</td>
    <td class="text-right">{{ number_format($source->Pemasukan_Tetap,0,",",".") }}</td>
</tr>
<tr>
    <td class="text-center">3</td>
    <td>Pemasukan Tidak Tetap</td>
    <td class="text-right">{{ number_format($source->Pemasukan_Tidak_Tetap,0,",",".") }}</td>
</tr>
<tr>
    <td class="text-center">4</td>
    <td>Pengeluaran Tetap</td>
    <td class="text-right">- {{ number_format($source->Pengeluaran_Tetap,0,",",".") }}</td>
</tr>
<tr>
    <td class="text-center">5</td>
    <td>Pengeluaran Tidak Tetap</td>
    <td class="text-right">- {{ number_format($source->Pengeluaran_Tidak_Tetap,0,",",".") }}</td>
</tr>
@php
$final_saldo = $saldo + $source->Pemasukan_Tetap + $source->Pemasukan_Tidak_Tetap - $source->Pengeluaran_Tetap - $source->Pengeluaran_Tidak_Tetap;
@endphp
<tr>
  <th colspan="2">Total</th>
  <th class="text-right">{{ number_format($final_saldo, 0, ",", ".") }}</th>
</tr>
</table>
<br/>
<p class="text-center sub-title">Wassalaamu'alaikum Warahmatullaahi Wabarakaatuh</p>
</body>