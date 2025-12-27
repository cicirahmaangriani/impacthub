<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Monitoring Event</h1>
                <p class="text-gray-600">Pantau semua event yang dibuat organizer.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}"
               class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                ← Kembali ke Dashboard
            </a>
        </div>

        <form method="GET" class="bg-white rounded-2xl shadow-sm p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Cari Judul</label>
                    <input type="text" name="q" value="{{ request('q') }}"
                           class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           placeholder="contoh: UI/UX">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Status</label>
                    <select name="status"
                            class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua</option>
                        <option value="draft" {{ request('status')==='draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ request('status')==='published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button class="w-full rounded-lg bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700">
                        Filter
                    </button>
                    <a href="{{ route('admin.events.index') }}"
                       class="w-full text-center rounded-lg border border-gray-300 px-4 py-2 hover:bg-gray-50">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-sm text-gray-600">
                            <th class="px-6 py-3">Event</th>
                            <th class="px-6 py-3">Organizer</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Peserta</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($events as $event)
                            <tr class="text-sm">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $event->title }}</div>
                                    <div class="text-gray-500 text-xs">{{ $event->start_date?->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $event->organizer?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $isPub = $event->status === 'published';
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                                        {{ $isPub ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ (int)$event->registered_count }}/{{ (int)$event->quota }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.events.show', $event->id) }}"
                                       class="text-indigo-600 hover:text-indigo-700 font-medium">
                                        Detail →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada event.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4">
                {{ $events->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
