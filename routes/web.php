<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\JobOfferController;
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

Route::get('/admin/home', [JobOfferController::class, 'publishOfferAll'])->middleware(['auth', 'admin'])->name('admin.home');
Route::get('/company/home', [JobOfferController::class, 'publishOfferAll'])->middleware(['auth', 'company'])->name('company.home');
Route::get('/candidate/home', [JobOfferController::class, 'publishOfferAll2'])->middleware(['auth', 'candidate'])->name('candidate.home');


Route::get('/home', [AdminController::class, 'home'])->middleware(['auth', 'admin'])->name('home');

Route::get('/archive-offer/{offerId}', [JobOfferController::class, 'archiveOffer'])->middleware(['auth', 'company'])->name('archive.joboffer');
Route::get('/update-offer/{offerId}', [JobOfferController::class, 'updateOfferView'])->middleware(['auth', 'company'])->name('update.joboffer');
Route::patch('/update-offer/{offerId}', [JobOfferController::class, 'update'])->middleware(['auth', 'company'])->name('update.joboffer');


Route::get('/candidat/CV', [CVController::class, 'storeCVview'])->middleware(['auth', 'candidate'])->name('candidate.CV');
Route::post('/CandidateCV', [CVController::class, 'storeCV'])->middleware(['auth', 'candidate'])->name('candidate.storeCV');
Route::get('/CandidateMyCV', [CVController::class, 'showCV'])->middleware(['auth', 'candidate'])->name('candidate.showCV');

Route::get('/candidate/download', [CVController::class, 'downloadCv'])->middleware(['auth', 'candidate'])->name('candidate.download');


Route::middleware('auth')->group(function () {

    //candidate
    Route::get('/profileCandidate', [ProfileController::class, 'edit'])->name('profile.editCandidate');
    Route::get('/CompleteprofileCandidate', [ProfileController::class, 'storeCandidateView'])->name('profile.CompleteCandidate');
    Route::post('/CompleteprofileCandidate', [ProfileController::class, 'storeCandidate'])->name('profile.storeCandidate');
    Route::get('/ShowProfileCandidate', [ProfileController::class, 'ShowProfileCandidate'])->name('profile.ShowProfileCandidate');

    //admin
    Route::get('/ShowProfileAdmin', [ProfileController::class, 'ShowProfileAdmin'])->name('profile.ShowProfileAdmin');


    //company
    Route::get('/profileCompany', [ProfileController::class, 'edit'])->name('profile.editCompany');
    Route::get('/CompleteprofileCompany', [ProfileController::class, 'storeCompanyView'])->name('profile.CompleteCompany');
    Route::post('/CompleteprofileCompany', [ProfileController::class, 'storeCompany'])->name('profile.storeCompany');
    Route::get('/ShowProfileCompany', [ProfileController::class, 'ShowProfileCompany'])->name('profile.ShowProfileCompany');
    Route::get('/AddOffer', [JobOfferController::class, 'StoreOfferView'])->name('company.AddOfferView');
    Route::post('/AddOffer', [JobOfferController::class, 'StoreOffer'])->name('company.AddOffer');

    Route::patch('/profileCandidate', [ProfileController::class, 'updateCandidate'])->name('profile.updateCandidate');
    // Route::patch('/profileCompany', [ProfileController::class, 'update'])->name('profile.updateCompany');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
