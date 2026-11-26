<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Hairdresser\DashboardController as HairdresserDashboardController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Tableau de bord général
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Espace Manager
Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->group(function () {
        Route::get('/', [ManagerDashboardController::class, 'index'])
            ->name('manager.dashboard');
    });

// Espace Coiffeur
Route::middleware(['auth', 'role:hairdresser'])
    ->prefix('coiffeur')
    ->group(function () {
        Route::get('/', [HairdresserDashboardController::class, 'index'])
            ->name('hairdresser.dashboard');
    });

// Espace Client
Route::middleware(['auth', 'role:customer'])
    ->prefix('client')
    ->group(function () {
        Route::get('/', [CustomerDashboardController::class, 'index'])
            ->name('customer.dashboard');
    });
    

// espace  du profil
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
