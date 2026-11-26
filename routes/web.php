<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Tableau de bord général
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// partie au manager
Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->group(function () {
        Route::get('/', function () {
            return 'Bienvenue dans l’espace Manager';
        })->name('manager.dashboard');
    });

// partie coiffeur
Route::middleware(['auth', 'role:hairdresser'])
    ->prefix('hairdresser')
    ->group(function () {
        Route::get('/', function () {
            return 'Bienvenue dans l’espace Coiffeur';
        })->name('hairdresser.dashboard');
    });

// partie client
Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->group(function () {
        Route::get('/', function () {
            return 'Bienvenue dans l’espace Client';
        })->name('customer.dashboard');
    });

// partie  du profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
