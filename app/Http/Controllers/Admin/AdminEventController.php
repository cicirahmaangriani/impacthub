<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index(Request $request)
    {
        $q = Event::query()->with(['user', 'organizer']);

        if ($request->filled('status')) {
            $q->where('status', $request->status);
        }

        $events = $q->latest()->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['user', 'organizer', 'registrations.user']);

        return view('admin.events.show', compact('event'));
    }
}
