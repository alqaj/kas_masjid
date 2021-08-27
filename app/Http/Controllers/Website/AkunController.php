<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akun;
use DataTables;
class AkunController extends Controller
{
	public function index()
	{
		return view('website.pages.akun.index');
	}

	public function ajax_index(Request $request)
	{
		$data = Akun::where('jenis_akun', $request->jenis_akun)->where('nama_akun', 'like', '%'.$request->filter.'%');
		return DataTables::eloquent($data)->make(true);
	}

	public function tambah()
	{
		return view('website.pages.akun.tambah');
	}

	public function simpan(Request $request)
	{
		$request->validate(
			[
				'jenis_akun' => 'required',
				'grup_akun' => 'required',
				'nama_akun' => 'required'
			]
		);

		Akun::create([
			'jenis_akun' => $request->jenis_akun,
			'grup_akun' => $request->grup_akun,
			'nama_akun' => $request->nama_akun
		]);

		return redirect()->route('website.akun.index')->with('success', 'Sukses menyimpan data akun!');
	}
}
