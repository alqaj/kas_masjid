<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kas;
use DB;
use Auth;
use Carbon\Carbon;
use DataTables;
use PDF;

class KasController extends Controller
{
    public function index()
    {
        return view('website.pages.kas.index');
    }

    public function ajax_akun(Request $request)
    {
        $type = $request->type;
        $data = DB::table('akun')->where('jenis_akun', $type)->get();

        return $data;
    }

    public function simpan(Request $request)
    {
        // return $request;
        $request->validate([
            'jenis_akun' => 'required',
            'nama_akun' => 'required',
            'tanggal_mutasi' => 'required',
            'jumlah' => 'required'
        ]);

        $last = Kas::where('company_id', Auth::user()->company_id)->orderBy('id', 'desc')->first();
        $saldo = 0;
        if($last){
            $saldo=$last->saldo;
        }
        $perkalian = 1;
        if($request->jenis_akun == "out"){
            $perkalian = -1;
        }
        $data = Kas::create([
            'jenis_akun' => $request->jenis_akun,
            'akun_id' => $request->nama_akun,
            'jumlah' => $request->jumlah,
            'tanggal_mutasi' => $request->tanggal_mutasi,
            'user_id' => Auth::user()->id,
            'note' => $request->note,
            'saldo' => 0,
            'company_id' => Auth::user()->company_id,
        ]);

        return redirect()->route('website.kas.index')->with('success', 'Sukses menyimpan Data!');
    }

    public function show()
    {
        return view('website.pages.kas.show');
    }

    // public function ajax_show(Request $request)
    // {
    //     $data = null;
    //     if($request->filter=="bulan")
    //     {
    //         $first_date_of_the_month = Carbon::now()->startOfMonth()->toDateString();
    //         $end_date_of_the_month = Carbon::now()->endOfMonth()->toDateString();

    //         $data = Kas::join('akun', 'akun.id', 'kas.akun_id')->where(DB::Raw('DATE(tanggal_mutasi)'), '>=', $first_date_of_the_month)->where(DB::Raw('DATE(tanggal_mutasi)'), '<=', $end_date_of_the_month)->where('company_id', Auth::user()->company_id);

    //     }
    //     elseif($request->filter=="minggu")
    //     {
    //         $first_date_of_week = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
    //         $end_date_of_week = Carbon::now()->endOfWeek(Carbon::MONDAY)->toDateString();
    //         $data = Kas::join('akun', 'akun.id', 'kas.akun_id')->where(DB::Raw('DATE(tanggal_mutasi)'), '>=', $first_date_of_week)->where(DB::Raw('DATE(tanggal_mutasi)'), '<=', $end_date_of_week)->where('company_id', Auth::user()->company_id);
    //     }

    //     return DataTables::eloquent($data)->make(true);

    // }
    public function show_history(Request $request)
    {
        $data = null;
        $saldo = 0;
        if($request->filter=="bulan")
        {
            $first_date_of_the_month = Carbon::now()->startOfMonth()->toDateString();
            $end_date_of_the_month = Carbon::now()->endOfMonth()->toDateString();

            $data = Kas::join('akun', 'akun.id', 'kas.akun_id')->where(DB::Raw('DATE(tanggal_mutasi)'), '>=', $first_date_of_the_month)->where(DB::Raw('DATE(tanggal_mutasi)'), '<=', $end_date_of_the_month)->where('company_id', Auth::user()->company_id)->orderBy('tanggal_mutasi', 'asc')->get();

            $saldo_plus = Kas::where(DB::Raw('DATE(tanggal_mutasi)'), '<', $first_date_of_the_month)->where('company_id', Auth::user()->company_id)->where('jenis_akun','in')->sum('jumlah');
            $saldo_minus = Kas::where(DB::Raw('DATE(tanggal_mutasi)'), '<', $first_date_of_the_month)->where('company_id', Auth::user()->company_id)->where('jenis_akun','out')->sum('jumlah');
            $saldo = $saldo_plus-$saldo_minus;

        }
        elseif($request->filter=="minggu")
        {
            $first_date_of_week = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
            $end_date_of_week = Carbon::now()->endOfWeek(Carbon::MONDAY)->toDateString();
            $data = Kas::join('akun', 'akun.id', 'kas.akun_id')->where(DB::Raw('DATE(tanggal_mutasi)'), '>=', $first_date_of_week)->where(DB::Raw('DATE(tanggal_mutasi)'), '<=', $end_date_of_week)->where('company_id', Auth::user()->company_id)->orderBy('tanggal_mutasi', 'asc')->get();
            $saldo_plus = Kas::where(DB::Raw('DATE(tanggal_mutasi)'), '<', $first_date_of_week)->where('company_id', Auth::user()->company_id)->where('jenis_akun','in')->sum('jumlah');
            $saldo_minus = Kas::where(DB::Raw('DATE(tanggal_mutasi)'), '<', $first_date_of_week)->where('company_id', Auth::user()->company_id)->where('jenis_akun','out')->sum('jumlah');
            $saldo = $saldo_plus-$saldo_minus;
        }
        else{
            abort(404);
        }

        $view_data = array();
        $last_saldo = $saldo;
        $i=1;
        $saldo_end =0;
        foreach ($data as $d) {
            if($d->jenis_akun=="in")
                $saldo += $d->jumlah;
            else
                $saldo-=$d->jumlah;
            $datum = [
                'no' => $i,
                'nama_akun' => $d->nama_akun,
                'tanggal_mutasi' => $d->tanggal_mutasi,
                'jumlah' => $d->jumlah,
                'saldo' => $saldo
            ];
            array_push($view_data, $datum);
            $saldo_end = $saldo;
            $i++;
        }

        // return $view_data;
        $view_data = array_reverse($view_data);
        return view('website.pages.kas.show2', ['view_data' => $view_data, 'last_saldo' => $last_saldo, 'filter' => $request->filter, 'saldo_end' => $saldo_end ]);

    }

    public function report()
    {
        $data = null;
        $saldo = 0;

        $first_date_of_the_month = Carbon::now()->startOfMonth()->toDateString();
        $end_date_of_the_month = Carbon::now()->endOfMonth()->toDateString();

        $source = Kas::join('akun', 'akun.id', 'kas.akun_id')
        ->select(DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pemasukan Tetap" THEN kas.jumlah else 0 END) as Pemasukan_Tetap'),
            DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pemasukan Tidak Tetap" THEN kas.jumlah else 0 END) as Pemasukan_Tidak_Tetap'),
            DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pengeluaran Tetap" THEN kas.jumlah else 0 END) as Pengeluaran_Tetap'),
            DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pengeluaran Tidak Tetap" THEN kas.jumlah else 0 END) as Pengeluaran_Tidak_Tetap'))

        ->where(DB::Raw('DATE(tanggal_mutasi)'), '>=', $first_date_of_the_month)
        ->where(DB::Raw('DATE(tanggal_mutasi)'), '<=', $end_date_of_the_month)
        ->where('company_id', Auth::user()->company_id)
        ->first();

        $saldo_plus = Kas::where(DB::Raw('DATE(tanggal_mutasi)'), '<', $first_date_of_the_month)->where('company_id', Auth::user()->company_id)->where('jenis_akun','in')->sum('jumlah');
        $saldo_minus = Kas::where(DB::Raw('DATE(tanggal_mutasi)'), '<', $first_date_of_the_month)->where('company_id', Auth::user()->company_id)->where('jenis_akun','out')->sum('jumlah');
        $saldo = $saldo_plus-$saldo_minus;

        $pdf = PDF::loadView('website.pages.kas.template_report', compact(['source', 'saldo', 'first_date_of_the_month', 'end_date_of_the_month']))->setPaper('a4', 'potrait');;
        return $pdf->stream();
    }

    public function show_grup_report()
    {
        $data = null;
        $saldo = 0;

        $first_date_of_the_month = Carbon::now()->startOfMonth()->toDateString();
        $end_date_of_the_month = Carbon::now()->endOfMonth()->toDateString();

        $source = Kas::join('akun', 'akun.id', 'kas.akun_id')
        ->select(DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pemasukan Tetap" THEN kas.jumlah else 0 END) as Pemasukan_Tetap'),
            DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pemasukan Tidak Tetap" THEN kas.jumlah else 0 END) as Pemasukan_Tidak_Tetap'),
            DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pengeluaran Tetap" THEN kas.jumlah else 0 END) as Pengeluaran_Tetap'),
            DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pengeluaran Tidak Tetap" THEN kas.jumlah else 0 END) as Pengeluaran_Tidak_Tetap'))

        ->where(DB::Raw('DATE(tanggal_mutasi)'), '>=', $first_date_of_the_month)
        ->where(DB::Raw('DATE(tanggal_mutasi)'), '<=', $end_date_of_the_month)
        ->where('company_id', Auth::user()->company_id)
        ->first();

        $saldo_plus = Kas::where(DB::Raw('DATE(tanggal_mutasi)'), '<', $first_date_of_the_month)->where('company_id', Auth::user()->company_id)->where('jenis_akun','in')->sum('jumlah');
        $saldo_minus = Kas::where(DB::Raw('DATE(tanggal_mutasi)'), '<', $first_date_of_the_month)->where('company_id', Auth::user()->company_id)->where('jenis_akun','out')->sum('jumlah');
        $saldo = $saldo_plus-$saldo_minus;

        return view('website.pages.kas.show_group_report', compact(['source', 'saldo']));

    }

    public function ajax_show_grup_report()
    {
        
        $saldo = 0;

        $first_date_of_the_month = Carbon::now()->startOfMonth()->toDateString();
        $end_date_of_the_month = Carbon::now()->endOfMonth()->toDateString();

        $source = Kas::join('akun', 'akun.id', 'kas.akun_id')
        ->select(DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pemasukan Tetap" THEN kas.jumlah else 0 END) as Pemasukan_Tetap'),
            DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pemasukan Tidak Tetap" THEN kas.jumlah else 0 END) as Pemasukan_Tidak_Tetap'),
            DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pengeluaran Tetap" THEN kas.jumlah else 0 END) as Pengeluaran_Tetap'),
            DB::Raw('SUM(CASE WHEN akun.grup_akun = "Pengeluaran Tidak Tetap" THEN kas.jumlah else 0 END) as Pengeluaran_Tidak_Tetap'))

        ->where(DB::Raw('DATE(tanggal_mutasi)'), '>=', $first_date_of_the_month)
        ->where(DB::Raw('DATE(tanggal_mutasi)'), '<=', $end_date_of_the_month)
        ->where('company_id', Auth::user()->company_id)
        ->first();

        $data = array(
            array(
                'label' => 'Pemasukan Tetap',
                'value' => $source->Pemasukan_Tetap,
                'color' => '#a2eb88',
            ),
            array(
                'label' => 'Pemasukan Tidak Tetap',
                'value' => $source->Pemasukan_Tidak_Tetap,
                'color' => '#a2eb88',
            ),
            array(
                'label' => 'Pengeluaran Tetap',
                'value' => $source->Pengeluaran_Tetap,
                'color' => '#eb8f88',
            ),
            array(
                'label' => 'Pengeluaran Tidak Tetap',
                'value' => $source->Pengeluaran_Tidak_Tetap,
                'color' => '#eb8f88',
            ),

        );

        return $data;
    }
}
