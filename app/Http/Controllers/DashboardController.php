<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display dashboard based on user role
     * Route: GET /dashboard
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        if ($user->isOrganizer()) {
            return $this->organizerDashboard();
        }

        return $this->participantDashboard();
    }

    /**
     * Admin dashboard route handler
     * Route: GET /admin/dashboard
     */
    public function admin()
    {
        // biar konsisten, /admin/dashboard tampilannya sama dengan adminDashboard()
        return $this->adminDashboard();
    }

    /**
     * ADMIN DASHBOARD
     */
    protected function adminDashboard()
    {
        $stats = [
            'total_users'         => User::count(),
            'total_events'        => Event::count(),
            'total_registrations' => Registration::count(),
            // aman: kalau scope paid() belum ada, fallback ke where('status','paid')
            'total_revenue'       => method_exists(Transaction::class, 'scopePaid')
                ? Transaction::paid()->sum('amount')
                : Transaction::where('status', 'paid')->sum('amount'),
        ];

        $recentEvents = Event::with('user')
            ->latest()
            ->limit(5)
            ->get();

        $recentRegistrations = Registration::with(['user', 'event'])
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentEvents', 'recentRegistrations'));
    }

    /**
     * ORGANIZER DASHBOARD
     */
    protected function organizerDashboard()
    {
        $user = auth()->user();

        $publishedCount = method_exists(Event::class, 'scopePublished')
            ? $user->events()->published()->count()
            : $user->events()->where('status', 'published')->count();

        $confirmedParticipants = method_exists(Registration::class, 'scopeConfirmed')
            ? Registration::whereHas('event', fn ($q) => $q->where('user_id', $user->id))->confirmed()->count()
            : Registration::whereHas('event', fn ($q) => $q->where('user_id', $user->id))
                ->where('status', 'confirmed')
                ->count();

        $paidTxQuery = Transaction::whereHas('registration.event', fn ($q) => $q->where('user_id', $user->id));
        $totalEarnings = method_exists(Transaction::class, 'scopePaid')
            ? $paidTxQuery->paid()->sum('organizer_amount')
            : $paidTxQuery->where('status', 'paid')->sum('organizer_amount');

        $stats = [
            'total_events'        => $user->events()->count(),
            'published_events'    => $publishedCount,
            'total_participants'  => $confirmedParticipants,
            'total_earnings'      => $totalEarnings,
        ];

        $myEvents = $user->events()
            ->with(['category', 'eventType'])
            ->withCount('registrations')
            ->latest()
            ->limit(6)
            ->get();

        return view('dashboard.organizer', compact('stats', 'myEvents'));
    }

    /**
     * PARTICIPANT DASHBOARD
     */
    protected function participantDashboard()
    {
        $user = auth()->user();

        $confirmedRegsCount = method_exists(Registration::class, 'scopeConfirmed')
            ? $user->registrations()->confirmed()->count()
            : $user->registrations()->where('status', 'confirmed')->count();

        $stats = [
            'total_registrations'      => $user->registrations()->count(),
            'confirmed_registrations'  => $confirmedRegsCount,
            'total_certificates'       => $user->certificates()->count(),
            'total_points'             => (int) ($user->total_points ?? 0),
        ];

        $myRegistrations = $user->registrations()
            ->with(['event', 'transaction'])
            ->latest()
            ->limit(6)
            ->get();

        // Recommended events: pakai scope kalau ada, fallback kalau tidak ada
        $eventsQuery = Event::query();

        if (method_exists(Event::class, 'scopePublished')) {
            $eventsQuery->published();
        } else {
            $eventsQuery->where('status', 'published');
        }

        if (method_exists(Event::class, 'scopeAvailableForRegistration')) {
            $eventsQuery->availableForRegistration();
        }

        $recommendedEvents = $eventsQuery
            ->limit(4)
            ->get();

        return view('dashboard.participant', compact('stats', 'myRegistrations', 'recommendedEvents'));
    }
}
