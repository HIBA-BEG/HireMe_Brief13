<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\JobOffer;



class JobOfferController extends Controller
{
    public function publishOfferAll()
    {
        $offers = JobOffer::with('entreprise')
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('jobOffers', ['offers' => $offers]);
    }

    public function publishOffer()
{
    $user = Auth::user();

    $offers = JobOffer::with('company')
        ->where('user_id', $user->id) 
        ->orderBy('created_at', 'desc')
        ->get();
    return view('company.offre', ['offers' => $offers]);
}

    public function storePublishOffer(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
                'titre' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'competences' => ['required', 'array'],
                'type_contrat' => ['required', 'string', 'in:a distance,hybride,a temps plein'],
                'emplacement' => ['required', 'string'],
            ]);

            $competencesJson = json_encode($request->input('competences'));

            $user = Auth::user();

            JobOffer::create([
                'nom' => $request->nom,
                'titre' => $request->titre,
                'description' => $request->description,
                'competences' => $competencesJson,
                'type_contrat' => $request->type_contrat,
                'emplacement' => $request->emplacement,
                'user_id' => $user->id,
            ]);

            return redirect()->route('jobs');
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }
}
