<?php

namespace App\Http\Controllers;


use \PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Models\CV;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class CVController extends Controller
{
    public function storeCVview(){
        $user = Auth::user();
        $cv = $user->cv;
        return view('candidate.CV',compact('cv'));
    }

    public function ShowCV()
    {
        
        $id=auth()->user()->id;
        $cv = DB::table('candidates')
                        ->join('cvs', "cvs.id_candidate", "=", "candidates.candidate_id")
                        ->where('candidates.candidate_id', $id)
                        ->get();
        // echo '<pre>';
        // print_r($CV);
        // echo '</pre>';
        // echo $CV[0]->email;
        // exit();
        return view('candidate.ShowCV',['cv'=>$cv]);
    }


    public function storeCV(Request $request)
    {
            $request->validate([
                'competences' => ['nullable', 'array'],
                'experiences' => ['nullable', 'array'],
                'cursus' => ['nullable', 'array'],
                'langues' => ['nullable', 'array'],
            ]);
    
            $user = Auth::user();
            $candidate = $user->candidate;
    
            if ($user->cv) {
                return redirect()->route('candidate.home')->with('error', 'You already have a CV.');
            }
    
            $competencesJson = json_encode($request->input('competences'));
            $experiencesJson = json_encode($request->input('experiences'));
            $cursusJson = json_encode($request->input('cursus'));
            $languesJson = json_encode($request->input('langues'));
    
            CV::create([
                'competences' => $competencesJson, 
                'experiences' => $experiencesJson, 
                'cursus' => $cursusJson, 
                'langues' => $languesJson, 
                'id_candidate' => $candidate->id,
            ]);
    
            return to_route('candidate.home'); 
    
    }


    // public function download()
    // {
    //     $cv = CV::where('id_candidate', auth()->id())->firstOrFail();

    //     $pdf = FacadePdf::loadView('candidate.CvPDF', compact('cv'));

    //     return $pdf->download('your_cv.pdf');
    // }

}
