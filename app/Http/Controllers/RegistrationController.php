<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
        $this->middleware('auth');
    }

    /**
     * Display user's registrations
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
    public function index(Request $request)
{
    // 1. Ambil data kategori dan tipe event dari database
    $categories = \App\Models\Category::all();
    $eventTypes = \App\Models\EventType::all();

    // 2. Query data utama (misal data pendaftaran atau event)
    $events = \App\Models\Event::query()
        ->when($request->category_id, function($query, $cid) {
            return $query->where('category_id', $cid);
        })
        ->paginate(9);

    // 3. KIRIM variabel ke view menggunakan compact
    return view('events.index', compact('events', 'categories', 'eventTypes'));
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
                auth()->user(),
                $event,
                $validated
            );

            if ($event->isFree()) {
                return redirect()->route('events.show', $registration)
                    ->with('success', 'Registration successful!');
            } else {
                return redirect()->route('transactions.show', $registration->transaction)
                    ->with('info', 'Please complete payment to confirm your registration.');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
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
            'cancellation_reason' => 'required|string',
        ]);

        try {
            $this->registrationService->cancelRegistration(
                $registration,
                $validated['cancellation_reason']
            );

            return back()->with('success', 'Registration cancelled successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
}