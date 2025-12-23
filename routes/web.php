<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CertificateController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Event Listing (detail route dipindah ke bawah)
Route::get('/events', [EventController::class, 'index'])->name('events.index');

/*
|--------------------------------------------------------------------------
| Auth Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard umum (bisa redirect per role di controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:isAdmin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | SHARED: Registrations view (Admin + Organizer + Participant)
    |--------------------------------------------------------------------------
    | Supaya admin bisa lihat registrasi, route ini tidak boleh participant-only.
    */
    Route::middleware(['can:viewRegistrations'])->group(function () {
        Route::get('/registrations', [RegistrationController::class, 'index'])
            ->name('registrations.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ORGANIZER ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:isOrganizer'])->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');

        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | PARTICIPANT ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:isParticipant'])->group(function () {

        // Registration
        Route::post('/events/{event}/register', [RegistrationController::class, 'store'])
            ->name('events.register');

        // Transactions (for paid events)
        Route::post('/events/{event}/pay', [TransactionController::class, 'store'])
            ->name('events.pay');

        // Certificate Download
        Route::get('/certificate/{registration}', [CertificateController::class, 'show'])
            ->name('certificate.show');
    });

    /*
    |--------------------------------------------------------------------------
    | Profile (semua role yang login boleh)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/events/{event}/hapus', [EventController::class, 'hapus'])
    ->name('events.hapus')
    ->middleware('auth');

});

// ⬇️ Route ini harus di BAWAH semua route /events/create, /events/{id}/edit, dll
// agar Laravel tidak menganggap "create" sebagai slug
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');


/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';