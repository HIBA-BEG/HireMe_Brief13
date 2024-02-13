<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Candidate extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

  
    public function about(){
        return view('chercheur.about');
    }
}
