<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Candidate;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function storeCandidateView()
    {
        return view('profile.CompleteCandidate');
    }

    public function ShowProfileCandidate()
    {
        return view('profile.ShowProfileCandidate');
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

        return Redirect::route('profile.editCandidate')->with('status', 'profile-updated');
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

        return to_route('profile.editCandidate');
    }

    public function storeCompany(Request $request)
    {
        try {
            $request->validate([
                'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'slogan' => ['nullable', 'string', 'max:255'],
                'industrie' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:255'],
            ]);


            $user = Company::create([
                'logo' => $request->file('logo') ? $request->file('logo')->store('img', 'public') : null,
                'slogan' => $request->slogan,
                'industrie' => $request->industrie,
                'description' => $request->description,
            ]);

            // dd($Company);

            Company::create($user);

            return redirect(route('profile.editCompany'));
        } catch (\Exception $e) {
            // Log or dd($e->getMessage()) to see the exception message
            dd($e->getMessage());
        }
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
