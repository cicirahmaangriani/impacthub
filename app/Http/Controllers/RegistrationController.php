<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Services\RegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RegistrationController extends Controller
{
    public function __construct(
        protected RegistrationService $registrationService
    ) {
        $this->middleware('auth');
    }

    /**
     * Display user's registrations
     */
    public function index(Request $request)
    {
        $status = $request->get('status');

        $registrations = $this->registrationService->getUserRegistrations(
            $request->user(),
            $status
        );

        return view('registrations.index', compact('registrations'));
    }

    /**
     * Delete registration from participant dashboard
     */
    public function destroy(Registration $registration)
    {
        // Pastikan milik user sendiri
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            $registration->delete();

            return back()->with('success', 'Event berhasil dihapus dari My Event.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Register for an event
     */
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            $registration = $this->registrationService->register(
                $request->user(),
                $event,
                $validated
            );

            // Tentukan gratis/berbayar
            $isFree = (float) ($event->price ?? 0) <= 0;

            // Redirect aman sesuai route yang ADA
            if ($isFree) {
                // kalau registrations.show ada, ke detail. kalau tidak, fallback ke index.
                if (Route::has('registrations.show')) {
                    return redirect()
                        ->route('registrations.show', $registration)
                        ->with('success', 'Registration successful!');
                }

                return redirect()
                    ->route('registrations.index')
                    ->with('success', 'Registration successful!');
            }

            // Event berbayar -> biasanya ke halaman pembayaran
            // kamu belum punya transactions.show, jadi fallback ke registrations.index
            if (Route::has('transactions.show') && $registration->relationLoaded('transaction') && $registration->transaction) {
                return redirect()
                    ->route('transactions.show', $registration->transaction)
                    ->with('info', 'Please complete payment to confirm your registration.');
            }

            return redirect()
                ->route('registrations.index')
                ->with('info', 'Registration created. Please complete payment (route payment belum diarahkan).');

        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified registration
     */
    public function show(Registration $registration)
{
    $this->authorize('view', $registration);

    // 1. Load relasi yang diperlukan
    $registration->load(['event.user', 'event.category', 'event.eventType', 'event.schedules', 'transaction', 'certificate']);

    // 2. Definisikan variabel $event dari pendaftaran ini
    $event = $registration->event;

    // 3. Ambil data event terkait agar baris 301 di Blade tidak error
    $relatedEvents = \App\Models\Event::where('category_id', $event->category_id)
        ->where('id', '!=', $event->id)
        ->limit(3)
        ->get();

    // 4. Kirim semua variabel ke view
    return view('events.show', compact('registration', 'event', 'relatedEvents'));
}

    /**
     * Cancel registration
     */
    public function cancel(Request $request, Registration $registration)
    {
        $this->authorize('cancel', $registration);

        $validated = $request->validate([
            'cancellation_reason' => 'required|string|max:500',
        ]);

        try {
            $this->registrationService->cancelRegistration(
                $registration,
                $validated['cancellation_reason']
            );

            return back()->with('success', 'Registration cancelled successfully!');
        } catch (\Throwable $e) {
            return back()
                ->with('error', $e->getMessage());
        }
    }
}
