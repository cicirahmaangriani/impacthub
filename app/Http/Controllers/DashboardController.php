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
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isOrganizer()) {
            return $this->organizerDashboard($request);
        } else {
            return $this->participantDashboard();
        }
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

    protected function organizerDashboard(Request $request)
    {
        $user = auth()->user();

        $filter = $request->get('filter');

        $stats = [
            'total_events' => $user->events()->count(),
            'published_events' => $user->events()->published()->count(),
            'total_participants' => Registration::whereHas('event', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->confirmed()->count(),
            'total_earnings' => \App\Models\Transaction::whereHas('registration.event', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->paid()->sum('organizer_amount'),
        ];

        $eventsQuery = $user->events()
            ->with(['category', 'eventType'])
            ->withCount('registrations')
            ->latest();

        if ($filter === 'published') {
            $eventsQuery->where('status', 'published');
        } elseif ($filter === 'draft') {
            $eventsQuery->where('status', 'draft');
        }

        $myEvents = $eventsQuery->limit(6)->get();

        return view('dashboard.organizer', compact('stats', 'myEvents', 'filter'));
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

        $myRegistrations = Registration::where('user_id', $user->id)
            ->whereHas('event') // ⬅️ BUANG REGISTRATION TANPA EVENT
            ->with([
                'event',
                'event.eventType',
                'event.category',
                'transaction',
            ])
            ->latest()
            ->limit(6)
            ->get();

        $recommendedEvents = Event::published()
            ->availableForRegistration()
            ->where('category_id', function ($query) use ($user) {
                $query->select('category_id')
                    ->from('events')
                    ->join('registrations', 'events.id', '=', 'registrations.event_id')
                    ->where('registrations.user_id', $user->id)
                    ->groupBy('category_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->limit(1);
            })
            ->limit(4)
            ->get();

        return view('dashboard.participant', compact('stats', 'myRegistrations', 'recommendedEvents'));
    }
}
