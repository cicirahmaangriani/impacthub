<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('events.index') }}" class="text-gray-600 hover:text-gray-900">
                    Events
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-gray-500">{{ $event->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Main --}}
        <div class="lg:col-span-2">

            {{-- Image --}}
            <div class="relative h-96 rounded-2xl overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 mb-6 shadow-xl">
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full text-white">
                        <svg class="h-32 w-32 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif

                <div class="absolute top-4 left-4 flex space-x-2">
                    @if($event->is_featured)
                        <span class="px-3 py-1 bg-yellow-400 text-yellow-900 rounded-full text-sm font-semibold">⭐ Featured</span>
                    @endif
                    @if($event->category)
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-gray-900 rounded-full text-sm font-semibold">
                            {{ $event->category->icon ?? '📌' }} {{ $event->category->name ?? 'Category' }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Title & Meta --}}
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                <div class="flex flex-wrap gap-2 mb-4">
                    @if($event->eventType)
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                            {{ $event->eventType->name }}
                        </span>
                    @endif

                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $event->venue_type === 'online' ? 'bg-blue-100 text-blue-800' : ($event->venue_type === 'offline' ? 'bg-orange-100 text-orange-800' : 'bg-teal-100 text-teal-800') }}">
                        @if($event->venue_type === 'online')
                            🌐 Online
                        @elseif($event->venue_type === 'offline')
                            📍 Offline
                        @else
                            🔄 Hybrid
                        @endif
                    </span>

                    @if($event->certificate_available)
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            🏆 Sertifikat
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $event->title }}</h1>

                {{-- Organizer --}}
                @if($event->user)
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ $event->user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($event->user->name) }}" alt="{{ $event->user->name }}" class="h-12 w-12 rounded-full">
                        <div>
                            <p class="text-sm text-gray-600">Diselenggarakan oleh</p>
                            <p class="font-semibold text-gray-900">{{ $event->user->name }}</p>
                        </div>
                    </div>
                @endif

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-4 pt-4 border-t">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-indigo-600">{{ $event->registered_count ?? 0 }}</div>
                        <div class="text-xs text-gray-600">Peserta</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $event->available_slots ?? 0 }}</div>
                        <div class="text-xs text-gray-600">Slot Tersisa</div>
                    </div>
                    @if(($event->points_reward ?? 0) > 0)
                        <div class="text-center">
                            <div class="text-2xl font-bold text-amber-600">+{{ $event->points_reward }}</div>
                            <div class="text-xs text-gray-600">Poin Reward</div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Description --}}
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h2>
                <div class="prose prose-indigo max-w-none">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            @if($event->objectives)
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">🎯 Tujuan Event</h2>
                    <div class="prose prose-indigo max-w-none text-gray-700">
                        {!! nl2br(e($event->objectives)) !!}
                    </div>
                </div>
            @endif

            @if($event->requirements)
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">📋 Persyaratan</h2>
                    <div class="prose prose-indigo max-w-none text-gray-700">
                        {!! nl2br(e($event->requirements)) !!}
                    </div>
                </div>
            @endif

            @if($event->instructor_info)
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">👨‍🏫 Instruktur</h2>
                    <div class="text-gray-700">
                        {!! nl2br(e($event->instructor_info)) !!}
                    </div>
                </div>
            @endif

        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-20">

                {{-- Price --}}
                <div class="text-center mb-6">
                    @if(method_exists($event, 'isFree') && $event->isFree())
                        <div class="text-4xl font-bold text-green-600">GRATIS</div>
                    @else
                        <div class="text-sm text-gray-600 mb-1">Harga</div>
                        <div class="text-4xl font-bold text-indigo-600">
                            Rp {{ number_format($event->price ?? 0, 0, ',', '.') }}
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="space-y-4 mb-6 pb-6 border-b">
                    <div class="flex items-start space-x-3">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Tanggal</p>
                            <p class="text-sm text-gray-600">
                                {{ optional($event->start_date)->format('d M Y') }} - {{ optional($event->end_date)->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    @if($event->location)
                        <div class="flex items-start space-x-3">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Lokasi</p>
                                <p class="text-sm text-gray-600">{{ $event->location }}</p>
                            </div>
                        </div>
                    @endif

                    @if($event->registration_deadline)
                        <div class="flex items-start space-x-3">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Batas Pendaftaran</p>
                                <p class="text-sm text-gray-600">{{ $event->registration_deadline->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Kuota --}}
                @php
                    $registered = $event->registered_count ?? 0;
                    $quota = max(1, (int)($event->quota ?? 1));
                    $pct = min(100, ($registered / $quota) * 100);
                @endphp

                <div class="mb-6">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-gray-600">Kuota Peserta</span>
                        <span class="font-semibold">{{ $registered }}/{{ $quota }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-indigo-600 h-3 rounded-full transition-all" style="width: {{ $pct }}%"></div>
                    </div>
                </div>

                {{-- CTA sesuai role (FINAL) --}}
                @auth
                    @php
                        $u = auth()->user();

                        $isAdmin = method_exists($u, 'isAdmin') ? $u->isAdmin() : (($u->role ?? null) === 'admin');
                        $isOrganizer = method_exists($u, 'isOrganizer') ? $u->isOrganizer() : (($u->role ?? null) === 'organizer');
                        $isParticipant = method_exists($u, 'isParticipant') ? $u->isParticipant() : (($u->role ?? null) === 'participant');

                        $isOwner = ((int)($event->user_id ?? 0) === (int)$u->id);

                        $alreadyRegistered = false;
                        if (method_exists($event, 'registrations')) {
                            $alreadyRegistered = $event->registrations()->where('user_id', $u->id)->exists();
                        }

                        $isFull = ($registered >= $quota);
                    @endphp

                    {{-- ✅ ADMIN: hanya monitoring + lihat registrasi --}}
                    @if($isAdmin)
                        <div class="space-y-3">
                            <div class="p-4 rounded-lg bg-gray-50 border border-gray-200 text-sm text-gray-600">
                                🔒 Anda login sebagai <span class="font-semibold">Admin</span>. Anda hanya bisa monitoring data event.
                            </div>

                            <a href="{{ route('registrations.index', ['event' => $event->slug]) }}"
                               class="block w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white text-center font-semibold rounded-lg transition">
                                📋 Lihat Registrasi
                            </a>
                        </div>

                    {{-- ORGANIZER pemilik event --}}
                    @elseif($isOrganizer && $isOwner)
                        <div class="space-y-3">
                            <a href="{{ route('events.edit', $event) }}"
                               class="block w-full py-3 px-4 bg-amber-500 hover:bg-amber-600 text-white text-center font-semibold rounded-lg transition">
                                ✏️ Edit Event
                            </a>

                            <form action="{{ route('events.destroy', $event) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus event ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full py-3 px-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                                    🗑️ Hapus Event
                                </button>
                            </form>

                            <a href="{{ route('registrations.index', ['event' => $event->slug]) }}"
                               class="block w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white text-center font-semibold rounded-lg transition">
                                📋 Lihat Registrasi
                            </a>
                        </div>

                    {{-- ORGANIZER bukan owner --}}
                    @elseif($isOrganizer && !$isOwner)
                        <div class="p-4 rounded-lg bg-gray-50 border border-gray-200 text-sm text-gray-600">
                            ℹ️ Anda login sebagai <span class="font-semibold">Organizer</span>, tapi ini bukan event milik Anda.
                        </div>

                    {{-- PARTICIPANT --}}
                    @elseif($isParticipant)
                        @if($alreadyRegistered)
                            <button disabled class="w-full py-3 px-4 bg-gray-300 text-gray-600 font-semibold rounded-lg cursor-not-allowed">
                                ✅ Sudah Terdaftar
                            </button>
                        @elseif($isFull)
                            <button disabled class="w-full py-3 px-4 bg-gray-300 text-gray-600 font-semibold rounded-lg cursor-not-allowed">
                                🚫 Kuota Penuh
                            </button>
                        @else
                            <form action="{{ route('events.register', ['event' => $event->slug]) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition shadow-lg hover:shadow-xl">
                                    🎯 Daftar Sekarang
                                </button>
                            </form>
                        @endif

                    @else
                        <div class="p-4 rounded-lg bg-gray-50 border border-gray-200 text-sm text-gray-600">
                            ℹ️ Role Anda tidak memiliki aksi pada event ini.
                        </div>
                    @endif

                @else
                    <a href="{{ route('login') }}" class="block w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white text-center font-semibold rounded-lg transition shadow-lg hover:shadow-xl">
                        Login untuk Mendaftar
                    </a>
                @endauth

            </div>
        </div>

    </div>
</div>
</x-app-layout>
