@if($events->where('is_featured', true)->count() > 0)
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-900">Event Unggulan 🌟</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($events->where('is_featured', true)->take(3) as $event)
                @include('events.partials.event-card', ['event' => $event])
            @endforeach
        </div>
    </div>
@endif
