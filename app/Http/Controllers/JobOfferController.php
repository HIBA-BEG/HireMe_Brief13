<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\JobOffer;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\DB;



class JobOfferController extends Controller
{
    // public function publishOfferAll()
    // {
    //     $query = JobOffer::with('company')
    //         ->orderBy('created_at', 'desc');

    //     $query->whereNull('archive');
    //     $offers = $query->get();
    //     return view('company.home', ['offers' => $offers]);
    // }


    public function publishOfferAll(Request $request)
    {
        $query = JobOffer::with('company')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%$search%")
                    ->orWhere('required_skills', 'like', "%$search%");
                $q->orWhere(function ($inner) use ($search) {
                    $inner->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(required_skills, '$[*]')) LIKE ?", ["%$search%"]);
                });

                $q->orWhere('contract_type', 'like', "%$search%")
                    ->orWhere('location', 'like', "%$search%");
            });
        }

        $query->whereNull('archive');
        $offers = $query->get();

        return view('company.home', ['offers' => $offers]);
    }

    public function publishOfferAll2(Request $request)
    {
        $query = JobOffer::with('company')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%$search%")
                    ->orWhere('required_skills', 'like', "%$search%");
                $q->orWhere(function ($inner) use ($search) {
                    $inner->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(required_skills, '$[*]')) LIKE ?", ["%$search%"]);
                });

                $q->orWhere('contract_type', 'like', "%$search%")
                    ->orWhere('location', 'like', "%$search%");
            });
        }

        $query->whereNull('archive');
        $offers = $query->get();

        return view('candidate.home', ['offers' => $offers]);
    }

    public function publishOffer()
    {
        $user = Auth::user();

        $offers = JobOffer::with('company')
            ->whereNull('archive')
            ->where('company_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('company.home', ['offers' => $offers]);
    }

    public function StoreOfferView()
    {
        return view('company.AddOffer');
    }

    public function updateOfferView($offerId)
    {
        $offer = JobOffer::find($offerId);
        return view('company.update', ['offer' => $offer]);
    }
    public function update(Request $request,$offerId)
    {
        $offer = JobOffer::find($offerId);

        if($offer){

            $validatedData = $request->validate([
                'titre' => 'required|string',
                'description' => 'required|string',
                'contract_type' => 'required|string|in:à distance,hybride,à temps plein',
                'location' => 'required|string',
            ]);
            
            $offer->update([
                'titre' => $validatedData['titre'],
                'description' => $validatedData['description'],
                'contract_type' => $validatedData['contract_type'],
                'location' => $validatedData['location'],
            ]);

            return redirect()->route('company.home');
        }
        return redirect()->route('company.home');
    
     }
    public function StoreOffer(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'required_skills' => 'required|array',
            'contract_type' => 'required|string|in:à distance,hybride,à temps plein',
            'location' => 'required|string',
        ]);

        $required_skillsJson = json_encode($request->input('required_skills'));
        // echo '<pre>';
        // print_r($validatedData);
        // echo '</pre>'; 
        $user = Auth::user();
        $company = $user->company;
        // dd($company);
        JobOffer::create([
            'company_id' => $company->id,
            'titre' => $validatedData['titre'],
            'description' => $validatedData['description'],
            'required_skills' => $required_skillsJson,
            'contract_type' => $validatedData['contract_type'],
            'location' => $validatedData['location'],
        ]);
        return to_route('company.home');
    }

    public function archiveOffer($offerId)
    {
        $offer = JobOffer::find($offerId);

        if ($offer) {
            $offer->update(['archive' => 1]);
            return redirect()->route('company.home')->with('success', 'Application successful!');
        }
        return redirect()->route('company.home')->with('error', 'Offer not found');
    }


}
