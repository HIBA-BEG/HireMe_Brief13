<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CandidateController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [AdminController::class, 'home'])->middleware(['auth', 'admin'])->name('home');

// Route::middleware('admin')->group(function () {
//     Route::get('/admin', [AdminController::class, 'home'])->name('admin.home');
//     // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
