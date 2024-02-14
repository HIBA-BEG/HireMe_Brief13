<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Candidate extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'profile_pic',
        'titre',
        'poste_actuel',
        'industrie',
        'adresse',
        'informations',
        'candidate_id',
    ];
  
    public function about(){
        return view('Candidate.about');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
