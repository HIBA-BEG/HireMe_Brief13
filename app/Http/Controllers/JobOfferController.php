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
        $offers = JobOffer::with('company')
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

    public function StoreOfferView()
    {
        return view('company.AddOffer');
    }

// storePublishOffer
    public function StoreOffer(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'required_skills' => 'required|string',
            'contract_type' => 'required|string',
            'location' => 'required|string',
        ]);

        // dd($request->hasFile('profile_pic'));

        JobOffer::create([
            'company_id' => auth()->user()->id,
            'titre' => $validatedData['titre'],
            'description' => $validatedData['description'],
            'required_skills' => $validatedData['required_skills'],
            'contract_type' => $validatedData['contract_type'],
            'location' => $validatedData['location'],
        ]);

        return to_route('company.AddOffer');
    }
}
