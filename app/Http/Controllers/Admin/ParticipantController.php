<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = User::query()
            ->where('role', 'participant')
            ->latest()
            ->paginate(10);

        return view('admin.participants.index', compact('participants'));
    }

    public function registrations(User $user)
    {
        $user->load(['registrations.event']);

        return view('admin.participants.registrations', compact('user'));
    }
}
