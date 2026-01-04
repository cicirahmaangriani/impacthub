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

    public function create()
    {
        $categories = Category::all();
        $eventTypes = EventType::all();
        return view('admin.events.create', compact('categories', 'eventTypes'));
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
            'category_id' => 'required|exists:categories,id',
            'event_type_id' => 'required|exists:event_types,id',
            'venue_type' => 'required|in:offline,online,hybrid',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'quota' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'registration_deadline' => 'required|date|before_or_equal:start_date',
            'requirements' => 'nullable|string',
            'instructor_info' => 'nullable|string',
            'location' => 'nullable|string',
            'meeting_link' => 'nullable|url',
            'objectives' => 'nullable|string',
            'points_reward' => 'nullable|integer|min:0',
            'certificate_available' => 'boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validated = $request->validate($rules);

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
        
        // Set user_id
        $validated['user_id'] = auth()->id();
        
        // Handle checkbox
        $validated['certificate_available'] = $request->has('certificate_available');
        
        // Set status based on button clicked
        $validated['status'] = $request->status === 'published' ? 'published' : 'draft';
        
        // Initialize registered_count
        $validated['registered_count'] = 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('events', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        $eventTypes = EventType::all();
        return view('admin.events.edit', compact('event', 'categories', 'eventTypes'));
    }

    public function update(Request $request, Event $event)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'event_type_id' => 'required|exists:event_types,id',
            'venue_type' => 'required|in:offline,online,hybrid',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'quota' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'registration_deadline' => 'required|date|before_or_equal:start_date',
            'requirements' => 'nullable|string',
            'instructor_info' => 'nullable|string',
            'location' => 'nullable|string',
            'meeting_link' => 'nullable|url',
            'objectives' => 'nullable|string',
            'points_reward' => 'nullable|integer|min:0',
            'certificate_available' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validated = $request->validate($rules);

        // Update slug if title changed
        if ($validated['title'] !== $event->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
        }
        
        // Handle checkbox
        $validated['certificate_available'] = $request->has('certificate_available');
        
        // Set status based on button clicked
        if ($request->has('status')) {
            $validated['status'] = $request->status === 'published' ? 'published' : 'draft';
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                \Storage::disk('public')->delete($event->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('events', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diupdate.');
    }

    public function destroy(Event $event)
    {
        // Delete image if exists
        if ($event->image) {
            \Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }
}
