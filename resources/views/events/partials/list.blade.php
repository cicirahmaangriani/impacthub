<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-900">Semua Event</h2>
        <span class="text-sm text-gray-600">{{ $events->total() }} event ditemukan</span>
    </div>

    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($events as $event)
                @include('events.partials.event-card', ['event' => $event])
            @endforeach
        </div>

        <div class="mt-8">
            {{ $events->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada event ditemukan</h3>
            <a href="{{ route('events.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Lihat Semua Event
            </a>
        </div>
    @endif
</div>
