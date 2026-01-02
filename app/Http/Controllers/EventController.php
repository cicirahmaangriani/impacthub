<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Show the form for creating a new event
     */
    public function create()
    {
        $this->authorize('create', Event::class);

        $categories = Category::active()->get();
        $eventTypes = EventType::all();

        return view('events.create', compact('categories', 'eventTypes'));
    }

    /**
     * Store a newly created event
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required',
        'event_type_id' => 'required',
        'venue_type' => 'required',
        'description' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'quota' => 'required|integer',
        'price' => 'required|numeric',
        'registration_deadline' => 'required|date',
        'requirements' => 'nullable|string',
        'instructor_info' => 'nullable|string',
        'location' => 'nullable|string',
        'meeting_link' => 'nullable|string',
        'objectives' => 'nullable|string',
        'points_reward' => 'nullable|integer|min:0',
        'certificate_available' => 'boolean',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);

    // Tambahkan user_id otomatis
    $validated['user_id'] = auth()->id();

    // Jika checkbox sertifikat tidak dicentang
    $validated['certificate_available'] = $request->has('certificate_available');

    // Tentukan status berdasarkan tombol
    $validated['status'] = $request->status === 'published'
        ? 'published'
        : 'draft';

    // Upload image jika ada
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('events', 'public');
    }

    Event::create($validated);

    return redirect()->route('dashboard')
        ->with('success', 'Event berhasil dibuat!');
}


    /**
     * Display the specified event
     */
    public function show(Event $event)
    {
        $event->load(['user', 'category', 'eventType', 'schedules']);
        
        $relatedEvents = Event::published()
            ->where('category_id', $event->category_id)
            ->where('id', '!=', $event->id)
            ->limit(4)
            ->get();

        return view('events.show', compact('event', 'relatedEvents'));
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        $categories = Category::active()->get();
        $eventTypes = EventType::all();

        return view('events.edit', compact('event', 'categories', 'eventTypes'));
    }

    /**
     * Update the specified event
     */
    public function update(Request $request, Event $event)
{
    $validated = $request->validate([
        'title' => 'required|string',
        'category_id' => 'required',
        'event_type_id' => 'required',
        'venue_type' => 'required',
        'description' => 'required',
        'requirements' => 'nullable',
        'location' => 'nullable|string',
        'meeting_link' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'price' => 'required|numeric',
        'quota' => 'required|integer',
        'registration_deadline' => 'required|date',
        'certificate_available' => 'boolean',
        'instructor_info' => 'nullable|string',
        'image' => 'nullable|image',
        'objectives' => 'nullable|string',
        'points_reward' => 'nullable|integer|min:0',
    ]);

    if ($validated['title'] !== $event->title) {
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
    }

    $validated['status'] = $request->status ?? $event->status;

    // Upload image jika ada
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $validated['image'] = $request->file('image')->store('events', 'public');
    }

    $event->update($validated);

    return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Remove the specified event
     */
   public function destroy(Event $event)
    {
    $this->authorize('delete', $event);

    try {
        // Hapus gambar jika ada
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus!');
    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
    }

    public function hapus(Event $event)
    {
    $this->authorize('delete', $event);
    return view('events.hapus', compact('event'));
    }


    /**
     * Publish event
     */
    public function publish(Event $event)
    {
        $this->authorize('update', $event);

        try {
            $this->eventService->publishEvent($event);
            return back()->with('success', 'Event published successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Cancel event
     */
    public function cancel(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'cancellation_reason' => 'required|string',
        ]);

        try {
            $this->eventService->cancelEvent($event, $validated['cancellation_reason']);
            return back()->with('success', 'Event cancelled successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }
    
}
