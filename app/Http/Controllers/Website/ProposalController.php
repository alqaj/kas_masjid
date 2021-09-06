<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use Auth;
use DataTables;
use DB;

class ProposalController extends Controller
{
    public function index()
    {
        return view('website.pages.proposal.index');
    }

    public function ajax_index()
    {
        $data = Proposal::where('company_id', Auth::user()->company_id)->orderBy('id', 'desc');
        return DataTables::eloquent($data)->make(true);
    }

    public function create()
    {
        return view('website.pages.proposal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'nama_instansi' => 'required',
            'alamat_instansi' => 'required',
            'penanggungjawab_instansi' => 'required',
            'pembawa' => 'required'
        ]);

                
        $proposal = Proposal::create([
            'judul' => $request->judul,
            'nama_instansi' => $request->nama_instansi,
            'alamat_instansi' => $request->alamat_instansi,
            'penanggungjawab_instansi' => $request->penanggungjawab_instansi,
            'pembawa' => $request->pembawa,
            'company_id' => Auth::user()->company_id,
        ]);

        $no ="";
        for($i=0; $i< (5-(strlen($proposal->id))); $i++)
        {
            $no .= "0";
        }
        $no .= $proposal->id;
        $proposal->nomor_proposal = 'INS-'.$no;
        $proposal->save();

        return redirect()->route('website.proposal.create')->with('success', $proposal->nomor_proposal);
    }

    public function history()
    {
        return view('website.pages.proposal.history');
    }

    public function ajax_history(Request $request)
    {
        $data = Proposal::join('kas','nomor_proposal', 'kas.note')
        ->select('judul', 'nama_instansi', 'alamat_instansi', 'penanggungjawab_instansi','pembawa', 'nomor_proposal', 'kas.jumlah', DB::Raw("DATE(kas.created_at)"))
        ->where('proposals.company_id', Auth::user()->company_id)->orderBy('kas.created_at', 'desc');
        return DataTables::eloquent($data)->make(true);
    }
}
