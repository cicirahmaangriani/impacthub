<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-start justify-between gap-4 mb-6">
            <div>
                <a href="{{ route('events.show', $event->slug) }}">
                   class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">← Kembali</a>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">{{ $event->title }}</h1>
                <p class="text-gray-600 mt-1">
                    Organizer: <span class="font-medium">{{ $event->organizer?->name ?? '-' }}</span>
                </p>
            </div>

            <div class="flex items-center gap-2">
                @php $isPub = $event->status === 'published'; @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    {{ $isPub ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ ucfirst($event->status) }}
                </span>

                @if($event->status === 'draft')
                    <form method="POST" action="{{ route('admin.events.approve', $event->id) }}">
                        @csrf
                        @method('PATCH')
                        <button class="rounded-lg bg-green-600 text-white px-4 py-2 hover:bg-green-700">
                            Approve
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.events.reject', $event->id) }}">
                        @csrf
                        @method('PATCH')
                        <button class="rounded-lg bg-red-600 text-white px-4 py-2 hover:bg-red-700">
                            Reject
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Ringkasan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <div class="text-gray-500">Tanggal</div>
                            <div class="font-medium text-gray-900">
                                {{ $event->start_date?->format('d M Y H:i') }} - {{ $event->end_date?->format('d M Y H:i') }}
                            </div>
                        </div>
                        <div>
                            <div class="text-gray-500">Lokasi</div>
                            <div class="font-medium text-gray-900">{{ $event->location ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500">Kuota</div>
                            <div class="font-medium text-gray-900">{{ (int)$event->registered_count }}/{{ (int)$event->quota }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500">Harga</div>
                            <div class="font-medium text-gray-900">Rp {{ number_format((float)$event->price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Deskripsi</h2>
                    <p class="text-gray-700 whitespace-pre-line">{{ $event->description ?? '-' }}</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Daftar Peserta (Registrations)</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr class="text-left text-sm text-gray-600">
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Daftar</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($event->registrations as $reg)
                                    <tr class="text-sm">
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $reg->user?->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $reg->user?->email ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ ucfirst($reg->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-700">
                                            {{ $reg->created_at?->diffForHumans() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                            Belum ada peserta yang mendaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h2>
                    <a href="{{ route('events.show', $event->slug) }}"
                       class="block w-full text-center rounded-lg border border-gray-300 px-4 py-2 hover:bg-gray-50">
                        Lihat Halaman Public
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
