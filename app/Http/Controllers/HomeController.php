<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index(){
        // if(Auth::id())
        // {
        //     $role=Auth()->user()->role;

        //     if($role == 'Admin')
        //     {
        //         return view('admin.home');
        //     }
        //     else if($role == 'Candidat')
        //     {
        //         return view('candidat.home');
        //     }
        //     else if($role == 'Company')
        //     {
        //         return view('company.home');
        //     }
        //     else 
        //     {
        //         return redirect()->back();
        //     }
        // }
    }
}
