<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VaccineCandidateController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', [VaccineCandidateController::class, 'search'])->name('welcome');

Route::post('/get-candidate', [VaccineCandidateController::class, 'getCandidate'])->name('getCandidate');

Route::get('/register-candidate', [VaccineCandidateController::class, 'create'])->name('register.candidate.create');
Route::post('/register-candidate', [VaccineCandidateController::class, 'store'])->name('register.candidate.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
