<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
    	$data = Company::where('id', Auth::user()->company_id)->first();
    	return view('website.pages.home', compact(['data']));
    }
}
