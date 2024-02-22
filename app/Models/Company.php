<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'logo',
        'slogan',
        'industrie',
        'description',
        'company_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
    public function joboffers()
    {
        return $this->hasmany(JobOffer::class, 'company_id');
    }
}
