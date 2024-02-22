<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Candidate;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        
        $user = Auth::user();
        
        if ($user->role == 'Candidate') {
            return view('profile.editCandidate', [
                'user' => $request->user(),
            ]);
        } else if ($user->role == 'Company') {
            return view('profile.editCompany', [
                'user' => $request->user(),
            ]);
        }
        
        return view('profile.editCandidate', [
            'user' => $request->user(),
        ]);
    }
    
    //CANDIDATE
    
    public function storeCandidateView()
    {
        return view('profile.CompleteCandidate');
    }

    public function ShowProfileCandidate()
    {
        
        $id=auth()->user()->id;
        $candidate = DB::table('users')
                        ->join('candidates', "candidates.candidate_id", "=", "users.id")
                        ->where('users.id', $id)
                        ->get();
        // echo '<pre>';
        // print_r($candidate);
        // echo '</pre>';
        // echo $candidate[0]->email;
        // exit();
        return view('profile.ShowProfileCandidate',['candidate'=>$candidate]);
    }


    /**
     * Update the user's profile information.
     */
    public function updateCandidate(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        
        return Redirect::route('profile.ShowProfileCandidate')->with('status', 'profile-updated');
    }

    public function updateCompany(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
        $request->user()->save();
        
        return Redirect::route('profile.editCompany')->with('status', 'profile-updated');
    }
    

    public function storeCandidate(Request $request)
    {
        $validatedData = $request->validate([
            'profile_pic' => 'required',
            'titre' => 'required|string',
            'poste_actuel' => 'required|string',
            'industrie' => 'required|string',
            'adresse' => 'required|string',
            'informations' => 'required|string',
        ]);

        if ($request->hasFile('profile_pic')) {
            $image = request()->file('profile_pic');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = 'service.png';
        }
        // dd($request->hasFile('profile_pic'));

        Candidate::create([
            'candidate_id' => auth()->user()->id,
            'profile_pic' => $imageName,
            'titre' => $validatedData['titre'],
            'poste_actuel' => $validatedData['poste_actuel'],
            'industrie' => $validatedData['industrie'],
            'adresse' => $validatedData['adresse'],
            'informations' => $validatedData['informations'],
        ]);

        return to_route('profile.ShowProfileCandidate');
    }
    
    //ADMIN
    public function ShowProfileAdmin()
    {
        
        $id=auth()->user()->id;
        $candidate = DB::table('users')
                        ->join('candidates', "candidates.candidate_id", "=", "users.id")
                        ->where('users.id', $id)
                        ->get();
        // echo '<pre>';
        // print_r($candidate);
        // echo '</pre>';
        // echo $candidate[0]->email;
        // exit();
        return view('profile.ShowProfileAdmin',['candidate'=>$candidate]);
    }

    //COMPANY
    
    public function storeCompanyView()
    {
        return view('profile.CompleteCompany');
    }

    public function ShowProfileCompany()
    {
        
        $id=auth()->user()->id;
        $company = DB::table('users')
                        ->join('companies', "companies.company_id", "=", "users.id")
                        ->where('users.id', $id)
                        ->get();
        // echo '<pre>';
        // print_r($company);
        // echo '</pre>';
        // echo $company[0]->email;
        // exit();
        return view('profile.ShowProfileCompany',['company'=>$company]);
    }

    
    public function storeCompany(Request $request)
    {
        $validatedData = $request->validate([
            'logo' => 'required',
            'slogan' => 'required|string',
            'industrie' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('logo')) {
            $image = request()->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = 'service.png';
        }
        // dd($request->hasFile('profile_pic'));

        Company::create([
            'company_id' => auth()->user()->id,
            'logo' => $imageName,
            'slogan' => $validatedData['slogan'],
            'industrie' => $validatedData['industrie'],
            'description' => $validatedData['description'],
        ]);

        return to_route('profile.ShowProfileCompany');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
