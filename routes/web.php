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

// // Public Event Listing & Detail
// Route::get('/events', [EventController::class, 'index'])->name('events.index');
// Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// // Test route - taruh di paling atas setelah use statements
// Route::get('/test-event-create', function() {
//     return 'Route berfungsi!';
// });

/*
|--------------------------------------------------------------------------
| Auth Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Event Management (Organizer Only)
    Route::middleware(['auth'])->group(function () {
        Route::resource('events', EventController::class);

    });

    // Registration
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])
        ->name('events.register');
    Route::get('/registrations', [RegistrationController::class, 'index'])
        ->name('registrations.index');

    // Transactions (for paid events)
    Route::post('/events/{event}/pay', [TransactionController::class, 'store'])
        ->name('events.pay');

    // Certificate Download
    Route::get('/certificate/{registration}', [CertificateController::class, 'show'])
        ->name('certificate.show');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/events/{event}/hapus', [EventController::class, 'hapus'])
    ->name('events.hapus')
    ->middleware('auth');

});


/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
