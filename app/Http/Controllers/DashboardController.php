<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Category;
use App\Models\EventType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard utama yang membagi role
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        // Ambil data kategori & tipe untuk filter global di layout dashboard
        $categories = Category::all();
        $eventTypes = EventType::all();

        // Simpan data ini ke view share agar tersedia di dashboard manapun
        view()->share('categories', $categories);
        view()->share('eventTypes', $eventTypes);

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isOrganizer()) {
            return $this->organizerDashboard($request);
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

    protected function participantDashboard()
    {
        $user = auth()->user();

        $stats = [
            'total_registrations' => $user->registrations()->count(),
            'confirmed_registrations' => $user->registrations()->confirmed()->count(),
            'total_certificates' => $user->certificates()->count(),
            'total_points' => $user->total_points ?? 0,
        ];

        $myRegistrations = $user->registrations()
            ->with(['event.category', 'event.eventType', 'transaction'])
            ->latest()
            ->limit(6)
            ->get();

        // Rekomendasi berdasarkan kategori yang paling sering diikuti
        $recommendedEvents = Event::published()
            ->availableForRegistration()
            ->limit(4)
            ->get();

        return view('dashboard.participant', compact('stats', 'myRegistrations', 'recommendedEvents'));
    }
}