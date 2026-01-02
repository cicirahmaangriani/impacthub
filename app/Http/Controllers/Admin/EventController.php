<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $q = Event::query()->with('organizer');

        if ($request->filled('status')) {
            $q->where('status', $request->string('status'));
        }

        if ($request->filled('q')) {
            $keyword = $request->string('q');
            $q->where('title', 'like', "%{$keyword}%");
        }

        $events = $q->latest()->paginate(10)->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load([
            'organizer',
            'user',
            'registrations.user',
        ]);

        return view('admin.events.show', compact('event'));
    }
}
