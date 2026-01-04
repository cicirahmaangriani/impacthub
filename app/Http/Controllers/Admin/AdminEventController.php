<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['organizer', 'registrations.user']);
        return view('admin.events.show', compact('event'));
    }

    public function store(Request $request)
{
    $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|numeric|min:0',
        'quota' => 'nullable|integer|min:1',
        'location' => 'nullable|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',

        // ✅ tambahin ini
        'registration_deadline' => 'nullable|date|before_or_equal:start_date',
    ];

    if (class_exists(\App\Models\Category::class)) $rules['category_id'] = 'required|exists:categories,id';
    if (class_exists(\App\Models\EventType::class)) $rules['event_type_id'] = 'required|exists:event_types,id';

    $validated = $request->validate($rules);

    $validated['user_id'] = auth()->id();
    $validated['status'] = 'draft';
    $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . \Illuminate\Support\Str::random(6);
    $validated['registered_count'] = 0;

    // ✅ FIX UTAMA: kalau user tidak isi deadline, otomatis pakai start_date
    if (empty($validated['registration_deadline'])) {
        $validated['registration_deadline'] = $validated['start_date'];
    }

    \App\Models\Event::create($validated);

    return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat.');
}
}
