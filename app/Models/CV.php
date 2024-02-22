<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    use HasFactory;

    protected $table = 'cvs';
    
    protected $fillable = [
        'competences',
        'experiences',
        'cursus',
        'langues',
        'id_candidate',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'id_candidate');
    }

}
