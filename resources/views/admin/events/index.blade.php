<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Monitoring Event</h1>
                <p class="text-sm text-gray-500">Daftar semua event yang dibuat oleh penyelenggara.</p>
            </div>
        </div>

        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('admin.events.index') }}" class="bg-white rounded-2xl shadow-sm p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="text-sm text-gray-600">Status</label>
                    <select name="status" class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="finished" {{ request('status') === 'finished' ? 'selected' : '' }}>Finished</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Cari Judul Event</label>
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Contoh: UI/UX, Workshop, Bootcamp..."
                        class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>
            </div>

            <div class="flex items-center gap-3 mt-4">
                <button class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    Terapkan
                </button>

                <a href="{{ route('admin.events.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                    Reset
                </a>
            </div>
        </form>

        {{-- List --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-sm text-gray-600">
                            <th class="px-4 py-3">Event</th>
                            <th class="px-4 py-3">Organizer</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Peserta</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($events as $event)
                            <tr class="text-sm">
                                <td class="px-4 py-3">
                                    <div class="font-semibold text-gray-900">{{ $event->title }}</div>
                                    <div class="text-gray-500 text-xs">
                                      {{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y') : '-' }}
                                    —
                                      {{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y') : '-' }}
                                    </div>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="text-gray-900">
                                        {{ $event->organizer->name ?? $event->user->name ?? '-' }}
                                    </div>
                                    <div class="text-gray-500 text-xs">
                                        {{ $event->organizer->email ?? $event->user->email ?? '' }}
                                    </div>
                                </td>

                                <td class="px-4 py-3">
                                    @php
                                        $status = $event->status ?? 'draft';
                                        $badge = match($status) {
                                            'published' => 'bg-green-100 text-green-700',
                                            'draft' => 'bg-gray-100 text-gray-700',
                                            'finished' => 'bg-blue-100 text-blue-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp

                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $badge }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-gray-900">
                                    @php
                                        $registered = $event->registered_count ?? $event->registrations_count ?? ($event->registrations->count() ?? 0);
                                        $quota = $event->quota ?? '-';
                                    @endphp
                                    {{ $registered }}/{{ $quota }}
                                </td>

                                <td class="px-4 py-3">
                                    <a
                                        href="{{ route('admin.events.show', $event->slug) }}"
                                        class="inline-flex items-center px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700"
                                    >
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-gray-500">
                                    Tidak ada event ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($events, 'links'))
                <div class="p-4">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
