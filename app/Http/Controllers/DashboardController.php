<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Dashboard umum: redirect sesuai role
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'organizer') {
            return view('dashboard.organizer');
        }

        return view('dashboard.participant');
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
}
