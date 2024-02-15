<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        // $id=auth()->user()->id;
        $JobOffers = JobOffer::get();
        return view('company.home',  ['JobOffers'=>$JobOffers]);
    }

}
