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
 	<!-- <p class="text-center sub-title">السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ<</p> -->
 	<p class="text-center sub-title">Assalaamu'alaikum Warahmatullaahi Wabarakaatuh</p>
 	<p class="paragraf">Alhamdulillah, Puji dan Syukur kami panjatkan ke hadirat Allah SWT, yang telah memberikan kami kesempatan untuk menyelesaikan Laporan Keuangan Bulanan Masjid. Laporan ini adalah salah bentuk transparansi terhadap amanah yang sudah di berikan kepada DKM. Semoga Allah selalu memberhahi kita semua.</p>

 	<table width="100%" class="table paragraf">
 		<tr>
 			<th>Nama Kegiatan</th>
 			<th>Tanggal Mutasi</th>
 			<th>Jumlah Mutasi</th>
 			<th>Saldo</th>
 		</tr>
 		<tr>
 			<td colspan="3">Saldo Bulan Lalu</td>
 			<td class="text-right">{{ number_format($last_saldo,0,".",",") }}</td>
 		</tr>
 		@foreach($view_data as $d)
 		<tr>
 			<td>{{ $d['nama_akun'] }}</td>
 			<td class="text-center">{{ str_split($d['tanggal_mutasi'], 10)[0] }}</td>
 			<td class="text-right">{{ number_format($d['jumlah'],0,".",",") }}</td>
 			<td class="text-right">{{ number_format($d['saldo'],0,".",",") }}</td>
 			@php $saldo_end = $d['saldo'] @endphp
 		</tr>
 		@endforeach
 		<tr>
 			<th colspan="3">Saldo Akhir</th>
 			<th>{{ number_format($saldo_end,0,".",",") }}</th>
 		</tr>
 	</table>
 	<br/>
 	<p class="text-center sub-title">Wassalaamu'alaikum Warahmatullaahi Wabarakaatuh</p>
 </body>