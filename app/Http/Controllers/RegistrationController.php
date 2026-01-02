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

            // Redirect based on event type
            if ($isFree) {
                return redirect()
                    ->route('dashboard')
                    ->with('success', 'Pendaftaran berhasil! Event gratis sudah dikonfirmasi.');
            }

            // Event berbayar - redirect ke dashboard dengan info pembayaran
            return redirect()
                ->route('dashboard')
                ->with('info', 'Pendaftaran berhasil! Silakan lanjutkan pembayaran untuk konfirmasi.');

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
