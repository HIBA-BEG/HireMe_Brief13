<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'required_skills',
        'contrat_type',
        'location',
        'company_id',
    ];

    public function entreprise()
{
    return $this->belongsTo(User::class, 'company_id');
}
}
