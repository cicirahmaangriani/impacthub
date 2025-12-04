<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display dashboard based on user role
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isOrganizer()) {
            return $this->organizerDashboard();
        } else {
            return $this->participantDashboard();
        }
    }

    protected function adminDashboard()
    {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_events' => Event::count(),
            'total_registrations' => Registration::count(),
            'total_revenue' => \App\Models\Transaction::paid()->sum('amount'),
        ];

        $recentEvents = Event::with('user')->latest()->limit(5)->get();
        $recentRegistrations = Registration::with(['user', 'event'])
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentEvents', 'recentRegistrations'));
    }

    protected function organizerDashboard()
    {
        $user = auth()->user();

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

        $myEvents = $user->events()
            ->with(['category', 'eventType'])
            ->withCount('registrations')
            ->latest()
            ->limit(6)
            ->get();

        return view('dashboard.organizer', compact('stats', 'myEvents'));
    }

    protected function participantDashboard()
    {
        $user = auth()->user();

        $stats = [
            'total_registrations' => $user->registrations()->count(),
            'confirmed_registrations' => $user->registrations()->confirmed()->count(),
            'total_certificates' => $user->certificates()->count(),
            'total_points' => $user->total_points,
        ];

        $myRegistrations = $user->registrations()
            ->with(['event', 'transaction'])
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