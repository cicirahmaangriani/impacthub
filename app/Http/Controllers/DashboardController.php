<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use App\Models\EventType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard umum: redirect sesuai role
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
            return $this->admin();
        } elseif ($user->isOrganizer()) {
            return $this->organizerDashboard($request);
        } else {
            return $this->participantDashboard();
        }
    }

    /**
     * Admin Dashboard view: resources/views/dashboard/admin.blade.php
     */
    public function admin()
    {
        $stats = [
            'total_users' => User::count(),
            'total_events' => Event::count(),
            'total_registrations' => Registration::count(),
            'total_revenue' => (float) Transaction::paid()->sum('amount'),
        ];

        $recentEvents = Event::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentRegistrations = Registration::with(['user', 'event'])
            ->latest()
            ->take(5)
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
            ->whereHas('event')
            ->with([
                'event',
                'event.eventType',
                'event.category',
                'transaction',
            ])
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
