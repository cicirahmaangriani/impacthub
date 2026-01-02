<x-app-layout>
<div class="min-h-screen bg-veil py-8">
    <div class="max-w-7xl mx-auto px-4">
    
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
        
        <!-- Main Content -->
        <div class="lg:col-span-2">
            
            <!-- Image -->
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
                
                <!-- Badges -->
                <div class="absolute top-4 left-4 flex space-x-2">
                    @if($event->is_featured)
                        <span class="px-3 py-1 bg-yellow-400 text-yellow-900 rounded-full text-sm font-semibold">
                            ⭐ Featured
                        </span>
                    @endif
                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-gray-900 rounded-full text-sm font-semibold">
                        {{ $event->category->icon }} {{ $event->category->name }}
                    </span>
                </div>
            </div>

            <!-- Title & Meta -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                        {{ $event->eventType->name }}
                    </span>
                    <span class="px-3 py-1 {{ $event->venue_type === 'online' ? 'bg-blue-100 text-blue-800' : ($event->venue_type === 'offline' ? 'bg-orange-100 text-orange-800' : 'bg-teal-100 text-teal-800') }} rounded-full text-sm font-medium">
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

                <!-- Organizer -->
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ $event->user->avatar_url }}" alt="{{ $event->user->name }}" class="h-12 w-12 rounded-full">
                    <div>
                        <p class="text-sm text-gray-600">Diselenggarakan oleh</p>
                        <p class="font-semibold text-gray-900">{{ $event->user->name }}</p>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 pt-4 border-t">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-indigo-600">{{ $event->registered_count }}</div>
                        <div class="text-xs text-gray-600">Peserta</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $event->available_slots }}</div>
                        <div class="text-xs text-gray-600">Slot Tersisa</div>
                    </div>
                    @if($event->points_reward > 0)
                        <div class="text-center">
                            <div class="text-2xl font-bold text-amber-600">+{{ $event->points_reward }}</div>
                            <div class="text-xs text-gray-600">Poin Reward</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h2>
                <div class="prose prose-indigo max-w-none">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            <!-- Objectives -->
            @if($event->objectives)
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">🎯 Tujuan Pembelajaran</h2>
                    <div class="prose prose-indigo max-w-none text-gray-700">
                        {!! nl2br(e($event->objectives)) !!}
                    </div>
                </div>
            @endif

            <!-- Requirements -->
            @if($event->requirements)
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">📋 Persyaratan</h2>
                    <div class="prose prose-indigo max-w-none text-gray-700">
                        {!! nl2br(e($event->requirements)) !!}
                    </div>
                </div>
            @endif

            <!-- Schedule -->
            @if($event->schedules->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">📅 Jadwal Kegiatan</h2>
                    <div class="space-y-4">
                        @foreach($event->schedules as $schedule)
                            <div class="flex space-x-4 p-4 border border-gray-200 rounded-lg hover:border-indigo-300 transition">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $schedule->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $schedule->description }}</p>
                                    <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                        <span>📅 {{ $schedule->start_time->format('d M Y') }}</span>
                                        <span>🕐 {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}</span>
                                        @if($schedule->location)
                                            <span>📍 {{ $schedule->location }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Instructor -->
            @if($event->instructor_info)
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">👨‍🏫 Instruktur</h2>
                    <div class="text-gray-700">
                        {!! nl2br(e($event->instructor_info)) !!}
                    </div>
                </div>
            @endif

        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            
            <!-- Registration Card -->
            <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-20">
                
                <!-- Price -->
                <div class="text-center mb-6">
                    @if($event->isFree())
                        <div class="text-4xl font-bold text-green-600">GRATIS</div>
                    @else
                        <div class="text-sm text-gray-600 mb-1">Harga</div>
                        <div class="text-4xl font-bold text-indigo-600">Rp {{ number_format($event->price, 0, ',', '.') }}</div>
                    @endif
                </div>

                <!-- Event Info -->
                <div class="space-y-4 mb-6 pb-6 border-b">
                    <!-- Dates -->
                    <div class="flex items-start space-x-3">
                        <svg class="h-5 w-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Tanggal</p>
                            <p class="text-sm text-gray-600">{{ $event->start_date->format('d M Y') }} - {{ $event->end_date->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Location -->
                    @if($event->location)
                        <div class="flex items-start space-x-3">
                            <svg class="h-5 w-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Lokasi</p>
                                <p class="text-sm text-gray-600">{{ $event->location }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Registration Deadline -->
                    <div class="flex items-start space-x-3">
                        <svg class="h-5 w-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Batas Pendaftaran</p>
                            <p class="text-sm text-gray-600">{{ $event->registration_deadline->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Registration Progress -->
                <div class="mb-6">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-gray-600">Kuota Peserta</span>
                        <span class="font-semibold">{{ $event->registered_count }}/{{ $event->quota }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-indigo-600 h-3 rounded-full transition-all" style="width: {{ ($event->registered_count / $event->quota) * 100 }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        @if($event->available_slots > 0)
                            ⚡ {{ $event->available_slots }} slot tersisa
                        @else
                            ❌ Event sudah penuh
                        @endif
                    </p>
                </div>

                <!-- CTA Button -->
                @auth
                    @if($event->canRegister())
                        @php
                            $alreadyRegistered = $event->registrations()->where('user_id', auth()->id())->exists();
                        @endphp
                        
                        @if($alreadyRegistered)
                            <button disabled class="w-full py-3 px-4 bg-gray-300 text-gray-600 font-semibold rounded-lg cursor-not-allowed">
                                ✅ Sudah Terdaftar
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
                        <button disabled class="w-full py-3 px-4 bg-red-100 text-red-600 font-semibold rounded-lg cursor-not-allowed">
                            ❌ Pendaftaran Ditutup
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white text-center font-semibold rounded-lg transition shadow-lg hover:shadow-xl">
                        Login untuk Mendaftar
                    </a>
                @endauth

                <!-- Share -->
                <div class="mt-6 pt-6 border-t">
                    <p class="text-sm font-medium text-gray-900 mb-3">Bagikan Event</p>
                    <div class="flex space-x-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('events.show', $event->slug)) }}" target="_blank" class="flex-1 py-2 px-3 bg-blue-600 hover:bg-blue-700 text-white text-center rounded-lg transition text-sm">
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('events.show', $event->slug)) }}&text={{ urlencode($event->title) }}" target="_blank" class="flex-1 py-2 px-3 bg-sky-500 hover:bg-sky-600 text-white text-center rounded-lg transition text-sm">
                            Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($event->title . ' - ' . route('events.show', $event->slug)) }}" target="_blank" class="flex-1 py-2 px-3 bg-green-600 hover:bg-green-700 text-white text-center rounded-lg transition text-sm">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Related Events -->
    <div class="bg-white rounded-2xl shadow p-3">
        @if($relatedEvents->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Event Serupa</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedEvents as $relatedEvent)
                        @include('events.partials.event-card', ['event' => $relatedEvent])
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
</x-app-layout>