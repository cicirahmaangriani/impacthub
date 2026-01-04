<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Date range filter
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->subMonths(3);
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now();

        // Overview Stats
        $stats = [
            'total_users' => User::count(),
            'total_events' => Event::count(),
            'published_events' => Event::where('status', 'published')->count(),
            'total_registrations' => Registration::count(),
            'confirmed_registrations' => Registration::where('status', 'confirmed')->count(),
            'total_revenue' => Transaction::where('status', 'paid')->sum('amount'),
            'pending_revenue' => Transaction::where('status', 'pending')->sum('amount'),
        ];

        // Top Events by Registration
        $topEvents = Event::withCount('registrations')
            ->orderBy('registrations_count', 'desc')
            ->take(5)
            ->get();

        // Events by Category
        $eventsByCategory = Event::select('category_id', DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        // Revenue by Month (last 6 months)
        $revenueByMonth = Transaction::where('status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // User Growth (last 6 months)
        $userGrowth = User::where('created_at', '>=', Carbon::now()->subMonths(6))
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // User by Role
        $usersByRole = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->get();

        // Recent Registrations
        $recentRegistrations = Registration::with(['user', 'event'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.reports.index', compact(
            'stats',
            'topEvents',
            'eventsByCategory',
            'revenueByMonth',
            'userGrowth',
            'usersByRole',
            'recentRegistrations',
            'startDate',
            'endDate'
        ));
    }
}
