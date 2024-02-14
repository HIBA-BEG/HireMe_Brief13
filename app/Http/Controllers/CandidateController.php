<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CandidateController extends Controller
{
    public function index(){
        $id=auth()->user()->id;
        $companies = Company::get();
        return view('candidate.home', ['companies'=>$companies]);
    }
}
