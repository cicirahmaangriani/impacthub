<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Transaction;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $data = [
            'total_users' => User::count(),
            'total_events' => Event::count(),
            'total_registrations' => Registration::count(),
            'total_paid_transactions' => Transaction::where('status', 'paid')->count(),
        ];

        return view('admin.reports.index', compact('data'));
    }
}
