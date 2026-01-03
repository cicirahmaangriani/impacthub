<x-app-layout>
<div class="min-h-screen bg-veil py-8" x-data="{ openModal: false }">
    <div class="max-w-7xl mx-auto px-4">
    
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg border transform transition-all duration-300" style="background: rgba(34, 197, 94, 0.1); backdrop-filter: blur(10px); border-color: rgba(34, 197, 94, 0.3); color: #166534;">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 p-4 rounded-lg border transform transition-all duration-300" style="background: rgba(239, 68, 68, 0.1); backdrop-filter: blur(10px); border-color: rgba(239, 68, 68, 0.3); color: #991b1b;">
            {{ session('error') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="mb-6 p-4 rounded-lg border transform transition-all duration-300" style="background: rgba(239, 68, 68, 0.1); backdrop-filter: blur(10px); border-color: rgba(239, 68, 68, 0.3); color: #991b1b;">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('events.index') }}" class="transition-all duration-300" style="color: #00385a;" onmouseover="this.style.color='#6a90b4'" onmouseout="this.style.color='#00385a'">
                    Events
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6" style="color: #94a2bf;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1" style="color: #6a90b4;">{{ $event->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Main --}}
        <div class="lg:col-span-2">

            {{-- Image --}}
            <div class="relative h-96 rounded-2xl overflow-hidden mb-6 shadow-xl transform transition-all duration-500 hover:shadow-2xl hover:scale-[1.02]" style="background: linear-gradient(to bottom right, #00385a, #6a90b4);">
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
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
            <div class="glass-card rounded-2xl p-6 mb-6 transform transition-all duration-300 hover:shadow-2xl">
                <div class="flex flex-wrap gap-2 mb-4">
                    @if($event->eventType)
                        <span class="px-3 py-1 rounded-full text-sm font-medium text-white transition-all duration-300 hover:shadow-lg" style="background: #6a90b4;">
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

                <h1 class="text-3xl md:text-4xl font-bold mb-4 gradient-text">{{ $event->title }}</h1>

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
                        <div class="text-2xl font-bold" style="color: #00385a;">{{ $event->registered_count ?? 0 }}</div>
                        <div class="text-xs" style="color: #6a90b4;">Peserta</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold" style="color: #6a90b4;">{{ $event->available_slots ?? 0 }}</div>
                        <div class="text-xs" style="color: #6a90b4;">Slot Tersisa</div>
                    </div>
                    @if(($event->points_reward ?? 0) > 0)
                        <div class="text-center">
                            <div class="text-2xl font-bold" style="color: #94a2bf;">+{{ $event->points_reward }}</div>
                            <div class="text-xs" style="color: #6a90b4;">Poin Reward</div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Description --}}
            <div class="glass-card rounded-2xl p-6 mb-6 transform transition-all duration-300 hover:shadow-2xl">
                <h2 class="text-xl font-bold mb-4 gradient-text">📖 Deskripsi</h2>
                <div class="prose prose-indigo max-w-none" style="color: #00385a;">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            @if($event->objectives)
                <div class="glass-card rounded-2xl p-6 mb-6 transform transition-all duration-300 hover:shadow-2xl">
                    <h2 class="text-xl font-bold mb-4 gradient-text">🎯 Tujuan Pembelajaran</h2>
                    <div class="prose prose-indigo max-w-none" style="color: #00385a;">
                        {!! nl2br(e($event->objectives)) !!}
                    </div>
                </div>
            @endif

            @if($event->requirements)
                <div class="glass-card rounded-2xl p-6 mb-6 transform transition-all duration-300 hover:shadow-2xl">
                    <h2 class="text-xl font-bold mb-4 gradient-text">📋 Persyaratan</h2>
                    <div class="prose prose-indigo max-w-none" style="color: #00385a;">
                        {!! nl2br(e($event->requirements)) !!}
                    </div>
                </div>
            @endif

            @if($event->instructor_info)
                <div class="glass-card rounded-2xl p-6 mb-6 transform transition-all duration-300 hover:shadow-2xl">
                    <h2 class="text-xl font-bold mb-4 gradient-text">👨‍🏫 Instruktur</h2>
                    <div style="color: #00385a;">
                        {!! nl2br(e($event->instructor_info)) !!}
                    </div>
                </div>
            @endif

        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            <div class="glass-card rounded-2xl p-6 sticky top-20 transform transition-all duration-300 hover:shadow-2xl">

                {{-- Price --}}
                <div class="text-center mb-6">
                    @if(method_exists($event, 'isFree') && $event->isFree())
                        <div class="text-4xl font-bold" style="color: #6a90b4;">GRATIS</div>
                    @else
                        <div class="text-sm mb-1" style="color: #00385a;">Harga</div>
                        <div class="text-4xl font-bold gradient-text">
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
                            <div class="p-4 rounded-lg border text-sm transform transition-all duration-300" style="background: rgba(148, 162, 191, 0.1); backdrop-filter: blur(10px); border-color: rgba(148, 162, 191, 0.3); color: #00385a;">
                                🔒 Anda login sebagai <span class="font-semibold">Admin</span>. Anda hanya bisa monitoring data event.
                            </div>

                            <a href="{{ route('registrations.index', ['event' => $event->slug]) }}"
                               class="block w-full py-3 px-4 text-white text-center font-semibold rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl" style="background: linear-gradient(135deg, #00385a 0%, #6a90b4 100%);">
                                📋 Lihat Registrasi
                            </a>
                        </div>

                    {{-- ORGANIZER pemilik event --}}
                    @elseif($isOrganizer && $isOwner)
                        <div class="space-y-3">
                            <a href="{{ route('events.edit', $event) }}"
                               class="block w-full py-3 px-4 text-white text-center font-semibold rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl" style="background-color: #6a90b4;">
                                ✏️ Edit Event
                            </a>

                            <form action="{{ route('events.destroy', $event) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus event ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full py-3 px-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                                    🗑️ Hapus Event
                                </button>
                            </form>

                            <a href="{{ route('registrations.index', ['event' => $event->slug]) }}"
                               class="block w-full py-3 px-4 text-white text-center font-semibold rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl" style="background: linear-gradient(135deg, #00385a 0%, #6a90b4 100%);">
                                📋 Lihat Registrasi
                            </a>
                        </div>

                    {{-- ORGANIZER bukan owner --}}
                    @elseif($isOrganizer && !$isOwner)
                        <div class="p-4 rounded-lg border text-sm transform transition-all duration-300" style="background: rgba(148, 162, 191, 0.1); backdrop-filter: blur(10px); border-color: rgba(148, 162, 191, 0.3); color: #00385a;">
                            ℹ️ Anda login sebagai <span class="font-semibold">Organizer</span>, tapi ini bukan event milik Anda.
                        </div>

                    {{-- PARTICIPANT --}}
                    @elseif($isParticipant)
                        @if($alreadyRegistered)
                            <button disabled class="w-full py-3 px-4 bg-gray-300 text-gray-600 font-semibold rounded-lg cursor-not-allowed transform transition-all duration-300">
                                ✅ Sudah Terdaftar
                            </button>
                        @elseif($isFull)
                            <button disabled class="w-full py-3 px-4 bg-gray-300 text-gray-600 font-semibold rounded-lg cursor-not-allowed transform transition-all duration-300">
                                🚫 Kuota Penuh
                            </button>
                        @else
                            <button @click="openModal = true" type="button" class="w-full py-3 px-4 text-white font-semibold rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl" style="background: linear-gradient(135deg, #00385a 0%, #6a90b4 100%); box-shadow: 0 4px 20px rgba(0, 56, 90, 0.3);">
                                🎯 Daftar Sekarang
                            </button>
                        @endif

                    @else
                        <div class="p-4 rounded-lg bg-gray-50 border border-gray-200 text-sm text-gray-600">
                            ℹ️ Role Anda tidak memiliki aksi pada event ini.
                        </div>
                    @endif

                @else
                    <a href="{{ route('login') }}" class="block w-full py-3 px-4 text-white text-center font-semibold rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl" style="background: linear-gradient(135deg, #00385a 0%, #6a90b4 100%); box-shadow: 0 4px 20px rgba(0, 56, 90, 0.3);">
                        Login untuk Mendaftar
                    </a>
                @endauth

            </div>

            <!-- Modal Form Pendaftaran -->
            <div x-show="openModal" 
                 class="fixed inset-0 z-50 overflow-y-auto" 
                 aria-labelledby="modal-title" role="dialog" aria-modal="true"
                 x-cloak>
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    
                    <div x-show="openModal" 
                         x-transition:enter="ease-out duration-300" 
                         x-transition:enter-start="opacity-0" 
                         x-transition:enter-end="opacity-100" 
                         x-transition:leave="ease-in duration-200" 
                         x-transition:leave-start="opacity-100" 
                         x-transition:leave-end="opacity-0" 
                         @click="openModal = false"
                         class="fixed inset-0 transition-opacity" style="background: rgba(1, 22, 43, 0.75); backdrop-filter: blur(10px);"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div x-show="openModal" 
                         x-transition:enter="ease-out duration-300" 
                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                         x-transition:leave="ease-in duration-200" 
                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         class="inline-block align-bottom rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full p-6" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(20px); border: 1px solid rgba(0, 56, 90, 0.1);">
                        
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold gradient-text">Formulir Pendaftaran</h3>
                            <button @click="openModal = false" type="button" class="transition-all duration-300" style="color: #94a2bf;" onmouseover="this.style.color='#00385a'" onmouseout="this.style.color='#94a2bf'">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('events.register', ['event' => $event->slug]) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium" style="color: #00385a;">First Name</label>
                                        <input type="text" name="first_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm transition-all duration-300" style="border-color: #d2dbcb;" onfocus="this.style.borderColor='#6a90b4'; this.style.boxShadow='0 0 0 3px rgba(106, 144, 180, 0.1)'" onblur="this.style.borderColor='#d2dbcb'; this.style.boxShadow=''">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium" style="color: #00385a;">Last Name</label>
                                        <input type="text" name="last_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm transition-all duration-300" style="border-color: #d2dbcb;" onfocus="this.style.borderColor='#6a90b4'; this.style.boxShadow='0 0 0 3px rgba(106, 144, 180, 0.1)'" onblur="this.style.borderColor='#d2dbcb'; this.style.boxShadow=''">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium" style="color: #00385a;">Phone Number</label>
                                    <input type="tel" name="phone" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm transition-all duration-300" style="border-color: #d2dbcb;" onfocus="this.style.borderColor='#6a90b4'; this.style.boxShadow='0 0 0 3px rgba(106, 144, 180, 0.1)'" onblur="this.style.borderColor='#d2dbcb'; this.style.boxShadow=''">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium" style="color: #00385a;">Tanggal Lahir</label>
                                    <input type="date" name="birth_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm transition-all duration-300" style="border-color: #d2dbcb;" onfocus="this.style.borderColor='#6a90b4'; this.style.boxShadow='0 0 0 3px rgba(106, 144, 180, 0.1)'" onblur="this.style.borderColor='#d2dbcb'; this.style.boxShadow=''">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium" style="color: #00385a;">Address</label>
                                    <textarea name="address" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm transition-all duration-300" style="border-color: #d2dbcb;" onfocus="this.style.borderColor='#6a90b4'; this.style.boxShadow='0 0 0 3px rgba(106, 144, 180, 0.1)'" onblur="this.style.borderColor='#d2dbcb'; this.style.boxShadow=''"></textarea>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-3 text-base font-medium text-white transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl sm:text-sm" style="background: linear-gradient(135deg, #00385a 0%, #6a90b4 100%);">
                                    Konfirmasi Pendaftaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Related Events -->
    @if($relatedEvents->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6 gradient-text">Event Serupa</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedEvents as $relatedEvent)
                    @include('events.partials.event-card', ['event' => $relatedEvent])
                @endforeach
            </div>
        </div>
    @endif
</x-app-layout>
