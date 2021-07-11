<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kas;
use DB;
use Auth;
class KasController extends Controller
{
    public function index()
    {
        return view('website.pages.kas');
    }

    public function ajax_akun(Request $request)
    {
        $type = $request->type;
        $data = DB::table('akun')->where('jenis_akun', $type)->get();

        return $data;
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'jenis_akun' => 'required',
            'nama_akun' => 'required',
            'tanggal_mutasi' => 'required',
            'jumlah' => 'required'
        ]);

        $data = Kas::create([
            'jenis_akun' => $request->jenis_akun,
            'akun_id' => $request->nama_akun,
            'jumlah' => $request->jumlah,
            'tanggal_mutasi' => $request->tanggal_mutasi,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('website.kas')->with('success', 'Sukses menyimpan Data!');
    }

    public function show()
    {
        return view('website.pages.kas.show');
    }
}
