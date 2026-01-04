<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-start justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $event->title }}</h1>
                <p class="text-sm text-gray-500">
                    Organizer:
                    <span class="font-medium text-gray-800">
                        {{ optional($event->organizer ?? $event->user)->name ?? '-' }}
                    </span>
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.events.edit', $event->id) }}"
                   class="px-4 py-2 rounded-lg bg-amber-600 text-white hover:bg-amber-700">
                    Edit Event
                </a>
                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin hapus event ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Hapus Event
                    </button>
                </form>
                <a href="{{ route('admin.events.index') }}"
                   class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left: Summary --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Ringkasan</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <div class="text-gray-500">Tanggal</div>
                            <div class="font-medium text-gray-900">
                                {{ optional($event->start_date)->format('d M Y H:i') ?? '-' }}
                                —
                                {{ optional($event->end_date)->format('d M Y H:i') ?? '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-gray-500">Lokasi</div>
                            <div class="font-medium text-gray-900">{{ $event->location ?? '-' }}</div>
                        </div>

                        <div>
                            <div class="text-gray-500">Kuota</div>
                            <div class="font-medium text-gray-900">
                                @php
                                    // kalau controller pakai withCount('registrations') akan ada registrations_count
                                    $registered = $event->registrations_count ?? ($event->registrations?->count() ?? 0);
                                    $quota = $event->quota ?? '-';
                                @endphp
                                {{ $registered }}/{{ $quota }}
                            </div>
                        </div>

                        <div>
                            <div class="text-gray-500">Harga</div>
                            <div class="font-medium text-gray-900">
                                Rp {{ number_format($event->price ?? 0, 0, ',', '.') }}
                            </div>
                        </div>

                        <div>
                            <div class="text-gray-500">Status</div>
                            <div class="font-medium text-gray-900">
                                {{ ucfirst($event->status ?? 'draft') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Deskripsi</h2>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        {{ $event->description ?? '-' }}
                    </p>
                </div>

                {{-- Registrations --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Daftar Peserta (Registrations)</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr class="text-left text-sm text-gray-600">
                                    <th class="px-3 py-2">Nama</th>
                                    <th class="px-3 py-2">Email</th>
                                    <th class="px-3 py-2">Status</th>
                                    <th class="px-3 py-2">Daftar</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($event->registrations as $reg)
                                    <tr class="text-sm">
                                        <td class="px-3 py-2 font-medium text-gray-900">
                                            {{ $reg->user->name ?? '-' }}
                                        </td>
                                        <td class="px-3 py-2 text-gray-700">
                                            {{ $reg->user->email ?? '-' }}
                                        </td>
                                        <td class="px-3 py-2">
                                            <span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">
                                                {{ $reg->status ?? 'registered' }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 text-gray-700">
                                            {{ optional($reg->created_at)->format('d M Y H:i') ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-3 py-8 text-center text-gray-500">
                                            Belum ada peserta yang mendaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Right: Actions --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h2>

                    <a href="{{ route('events.show', $event) }}"
                       class="block w-full text-center rounded-lg border border-gray-300 px-4 py-2 hover:bg-gray-50">
                        Lihat Halaman Public
                    </a>

                    @if(($event->status ?? 'draft') === 'draft')
                        <div class="grid grid-cols-1 gap-3 mt-4">
                            <form method="POST" action="{{ route('admin.events.approve', $event->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="w-full rounded-lg bg-green-600 text-white px-4 py-2 hover:bg-green-700">
                                    Approve (Publish)
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.events.reject', $event->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="w-full rounded-lg bg-red-600 text-white px-4 py-2 hover:bg-red-700">
                                    Reject
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Info</h2>
                    <p class="text-sm text-gray-600">
                        Pastikan controller load relasi
                        <code class="px-1 py-0.5 bg-gray-100 rounded">registrations.user</code>
                        agar tabel peserta tampil tanpa N+1 query.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
