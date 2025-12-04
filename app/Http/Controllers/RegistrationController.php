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
    public function index(Request $request)
    {
        $status = $request->get('status');
        $registrations = $this->registrationService->getUserRegistrations(
            auth()->user(),
            $status
        );

        return view('registrations.index', compact('registrations'));
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
                return redirect()->route('registrations.show', $registration)
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

        $registration->load(['event', 'transaction', 'certificate']);

        return view('registrations.show', compact('registration'));
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