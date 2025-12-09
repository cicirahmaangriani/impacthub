<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /*
    |--------------------------------------------------------------------------
    | LIST EVENTS (Published Only)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $events = Event::published()->latest()->paginate(12);
        return view('events.index', compact('events'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE PAGE
    |--------------------------------------------------------------------------
    */
    public function create()
{
    $categories = Category::all();
    $eventTypes = EventType::all();

    return view('events.create', compact('categories', 'eventTypes'));
}

    /*
    |--------------------------------------------------------------------------
    | STORE EVENT (Published / Draft)
    |--------------------------------------------------------------------------
    */
   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'event_type_id' => 'required|exists:event_types,id',
        'venue_type' => 'required|in:online,offline,hybrid',
        'description' => 'required|string',
        'requirements' => 'nullable|string',
        'instructor_info' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'quota' => 'required|integer|min:1',
        'location' => 'required|string',
        'meeting_link' => 'nullable|url',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'registration_deadline' => 'required|date',
        'certificate_available' => 'nullable|boolean',
        'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    // Jika category_id tetap NULL → hentikan
    if (!$request->category_id) {
        return back()
            ->withErrors(['category_id' => 'Kategori wajib dipilih'])
            ->withInput();
    }

    // Tambahan field
    $validated['user_id'] = auth()->id();
    $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
    $validated['certificate_available'] = $request->has('certificate_available');
    $validated['status'] = $request->status === 'published' ? 'published' : 'draft';

    // Upload image
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('events', 'public');
    }

    Event::create($validated);

    return redirect()->route('dashboard')
        ->with('success', "Event berhasil disimpan sebagai {$validated['status']}!");
}


    /*
    |--------------------------------------------------------------------------
    | SHOW DETAIL EVENT
    |--------------------------------------------------------------------------
    */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT EVENT PAGE
    |--------------------------------------------------------------------------
    */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        $categories = Category::all();
        $eventTypes  = EventType::all();

        return view('events.edit', compact('event', 'categories', 'eventTypes'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE EVENT
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'category_id'           => 'required|exists:categories,id',
            'event_type_id'         => 'required|exists:event_types,id',
            'description'           => 'required|string',

            'venue_type'            => 'required|in:online,offline,hybrid',
            'location'              => 'nullable|string',

            'start_date'            => 'required|date',
            'end_date'              => 'required|date|after_or_equal:start_date',

            'registration_deadline' => 'required|date',

            'requirements'          => 'nullable|string',
            'instructor_info'       => 'nullable|string',

            'price'                 => 'nullable|numeric|min:0',
            'quota'                 => 'required|integer|min:1',

            'contact_person'        => 'required|string',
            'contact_phone'         => 'required|string',

            'status'                => 'nullable|in:draft,published',
        ]);

        // Update slug jika judul berubah
        if ($request->title !== $event->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
        }

        // Image update
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE EVENT
    |--------------------------------------------------------------------------
    */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus!');
    }
}
