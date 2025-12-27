<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CertificateController;

use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\EventVerificationController;
use App\Http\Controllers\Admin\AdminEventController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'))->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');

/*
|--------------------------------------------------------------------------
| Auth Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard umum (redirect per role di controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['can:isAdmin'])
        ->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

            // Monitoring Event (Admin)
            Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
            Route::get('/events/{event}', [AdminEventController::class, 'show'])->name('events.show');

            // Verifikasi Event (Admin)
            Route::patch('/events/{event}/approve', [EventVerificationController::class, 'approve'])->name('events.approve');
            Route::patch('/events/{event}/reject', [EventVerificationController::class, 'reject'])->name('events.reject');

            // Monitoring Peserta (Admin)
            Route::get('/participants', [ParticipantController::class, 'index'])->name('participants.index');
            Route::get('/participants/{user}/registrations', [ParticipantController::class, 'registrations'])->name('participants.registrations');
        });

    /*
    |--------------------------------------------------------------------------
    | SHARED: Registrations view (Admin + Organizer + Participant)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:viewRegistrations'])->group(function () {
        Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ORGANIZER ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:isOrganizer'])->group(function () {
        Route::get('/events/create-event', [EventController::class, 'create'])->name('events.create-event');
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
        Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('events.register');
        Route::post('/events/{event}/pay', [TransactionController::class, 'store'])->name('events.pay');
        Route::get('/certificate/{registration}', [CertificateController::class, 'show'])->name('certificate.show');
    });

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
