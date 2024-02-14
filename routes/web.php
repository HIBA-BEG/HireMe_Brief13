<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CVController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// route::get('/home',[HomeController::class, 'index']);

Route::get('/admin/home', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.home');
Route::get('/company/home', [CompanyController::class, 'index'])->middleware(['auth', 'company'])->name('company.home');
Route::get('/candidat/home', [CandidateController::class, 'index'])->middleware(['auth', 'candidate'])->name('candidate.home');


Route::get('/home', [AdminController::class, 'home'])->middleware(['auth', 'admin'])->name('home');

Route::get('/candidat/CV', [CVController::class, 'createCV'])->middleware(['auth', 'candidate'])->name('candidate.CV');


// Route::get('/jobOffers', [EmploiController::class, 'publishOfferAll'])->name('AllOffers');
// Route::get('/jobs', [EmploiController::class, 'publishOffer'])->middleware(['auth', 'entreprise'])->name('jobs');
// Route::post('/jobs', [EmploiController::class, 'storePublishOffer'])->name('jobs.store');


// Route::get('/cvs', [CvController::class, 'createCV'])->middleware(['auth', 'chercheur'])->name('cvs');
// Route::post('/cvs', [CvController::class, 'storeCV'])->name('cvs.store');
// Route::get('/download', [CVController::class, 'downloadCv'])->middleware(['auth', 'chercheur'])->name('downloadCv');



Route::middleware('auth')->group(function () {
    Route::get('/profileCandidate', [ProfileController::class, 'edit'])->name('profile.editCandidate');
    Route::get('/CompleteprofileCandidate', [ProfileController::class, 'storeCandidateView'])->name('profile.CompleteCandidate');
    Route::post('/CompleteprofileCandidate', [ProfileController::class, 'storeCandidate'])->name('profile.storeCandidate');
    Route::get('/ShowProfileCandidate', [ProfileController::class, 'ShowProfileCandidate'])->name('profile.ShowProfileCandidate');

    Route::get('/profileCompany', [ProfileController::class, 'edit'])->name('profile.editCompany');
    Route::post('/CompleteprofileCompany', [ProfileController::class, 'storeCompany'])->name('profile.CompleteCompany');
    Route::patch('/profileCandidate', [ProfileController::class, 'updateCandidate'])->name('profile.updateCandidate');
    // Route::patch('/profileCompany', [ProfileController::class, 'update'])->name('profile.updateCompany');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
