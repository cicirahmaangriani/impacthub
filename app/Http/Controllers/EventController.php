<?php

// app/Http/Controllers/EventController.php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\EventType;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of events
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'category_id',
            'event_type_id',
            'price_min',
            'price_max',
            'venue_type',
            'search',
            'featured',
            'status',
            'sort_by',
            'sort_order',
            'per_page'
        ]);

        $events = $this->eventService->getPublishedEvents($filters);
        $categories = Category::active()->get();
        $eventTypes = EventType::all();

        return view('events.index', compact('events', 'categories', 'eventTypes'));
    }

    /**
     * Show the form for creating a new event
     */
    public function create()
    {
    $categories = Category::active()->get();
    $eventTypes = EventType::all();

    return view('events.create', compact('categories', 'eventTypes'));
    }


    /**
     * Store a newly created event
     */
    public function store(Request $request)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string',
        'sub_category' => 'nullable|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'event_type' => 'required|in:offline,online',
        'start_date' => 'required|date',
        'start_time' => 'required',
        'end_date' => 'required|date|after_or_equal:start_date',
        'end_time' => 'required',
        'location' => 'required|string',
        'address' => 'nullable|string',
        'meeting_link' => 'nullable|url',
        'max_participants' => 'required|integer|min:1',
        'registration_fee' => 'required|numeric|min:0',
        'registration_deadline' => 'required|date',
        'has_certificate' => 'nullable|boolean',
        'requirements' => 'nullable|string',
        'instructor' => 'nullable|string',
        'contact_person' => 'required|string',
        'contact_phone' => 'required|string',
        ]);

        $validated['user_id'] = auth()->id();
    $validated['status'] = 'published'; // atau 'draft'
    $validated['slug'] = \Str::slug($validated['title']) . '-' . \Str::random(6);
    $validated['has_certificate'] = $request->has('has_certificate') ? 1 : 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event = $this->eventService->createEvent($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event created successfully!');
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

    /**
     * Show the form for editing the specified event
     */
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
        $this->authorize('update', $event);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'event_type_id' => 'required|exists:event_types,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'objectives' => 'nullable|string',
            'requirements' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
            'location' => 'nullable|string',
            'venue_type' => 'required|in:online,offline,hybrid',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'registration_deadline' => 'required|date|before:start_date',
            'instructor_info' => 'nullable|string',
            'certificate_available' => 'boolean',
            'points_reward' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event = $this->eventService->updateEvent($event, $validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        try {
            $this->eventService->deleteEvent($event);
            return redirect()->route('events.index')
                ->with('success', 'Event deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
