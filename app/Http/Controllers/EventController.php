<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->q . '%');
            })
            // kalau mau public cuma published, aktifkan ini:
            // ->where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        // route kamu pakai {event:slug}, jadi $event sudah otomatis berdasarkan slug
        $event->load([
            'user',
            'organizer',
            'registrations.user',
        ]);

        // ✅ karena view sekarang ada di resources/views/events/show.blade.php
        return view('events.show', compact('event'));
    }
}
