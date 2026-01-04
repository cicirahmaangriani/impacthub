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

// Quick actions admin
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSettingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    try {
        // Ambil 6 event terbaru yang published - simplified query
        $events = \App\Models\Event::select('id', 'user_id', 'category_id', 'event_type_id', 'title', 'slug', 'description', 
                     'location', 'price', 'quota', 'registered_count', 'start_date', 
                     'registration_deadline', 'image', 'status', 'created_at')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
    } catch (\Exception $e) {
        // Jika ada error, gunakan collection kosong
        \Log::error('Error loading events on welcome page: ' . $e->getMessage());
        $events = collect([]);
    }
    
    return view('welcome', compact('events'));
})->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events.index');

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
    ->middleware(['auth', 'can:isAdmin'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        // ✅ Admin Create Event
        Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
        Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');

        // ✅ Monitoring Event (Admin)
        Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
        Route::get('/events/{event:id}', [AdminEventController::class, 'show'])->name('events.show');

        // ✅ Verifikasi Event (Admin) - dipakai di show.blade.php
        Route::patch('/events/{event:id}/approve', [EventVerificationController::class, 'approve'])->name('events.approve');
        Route::patch('/events/{event:id}/reject', [EventVerificationController::class, 'reject'])->name('events.reject');

        // ✅ Manage Users (pakai participants yang sudah ada)
        Route::get('/manage-users', [ParticipantController::class, 'index'])->name('manage-users.index');

        // ✅ Reports + Settings (controller kamu)
        Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');

    // Quick Actions pages
    Route::get('/manage-users', [\App\Http\Controllers\Admin\ManageUserController::class, 'index'])->name('manage-users.index');
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
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
        Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('events.register');
        Route::post('/events/{event}/pay', [TransactionController::class, 'store'])->name('events.pay');
        Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    });

    // Certificate Download (shared across roles)
    Route::get('/certificate/{registration}', [CertificateController::class, 'show'])
        ->name('certificate.show');

    /*
    |--------------------------------------------------------------------------
    | Profile
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
