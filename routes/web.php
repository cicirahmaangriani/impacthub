<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CertificateController;

// =========================
// PUBLIC ROUTES
// =========================

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events.index');

// =========================
// AUTH ROUTES (ONLY WHEN LOGGED IN)
// =========================

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // PRIVATE CRUD (create, store, edit, update, delete)
    Route::resource('events', EventController::class)->except(['index', 'show']);

    // Registrations
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])
        ->name('events.register');

    Route::get('/registrations', [RegistrationController::class, 'index'])
        ->name('registrations.index');

    // Payments
    Route::post('/events/{event}/pay', [TransactionController::class, 'store'])
        ->name('events.pay');

    // Certificates
    Route::get('/certificate/{registration}', [CertificateController::class, 'show'])
        ->name('certificate.show');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================
// PUBLIC EVENT DETAIL — SLUG
// =========================
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

require __DIR__.'/auth.php';
