<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class TabunganController extends Controller
{
    public function index(){
        $data = Auth::user();
        return view('website.pages.tabungan_qurban.index', compact(['data']));
    }
}
