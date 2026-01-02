<x-app-layout>

    {{-- Title --}}
    @section('title', 'Jelajah Event & Bootcamp')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Hero Section --}}
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 md:p-12 mb-8 text-white">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Temukan Peluang <span class="text-yellow-300">Berkembang</span> Bersama Kami
                </h1>
                <p class="text-lg md:text-xl text-indigo-100 mb-6">
                    Ikuti ratusan event, bootcamp, dan kegiatan sosial yang mengembangkan skill dan memperluas jaringan/ koneksi anda
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#events" 
                        class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-indigo-50 transition">
                        Jelajah Event
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>

                    @auth
                        @if(auth()->user()->isOrganizer())
                            <a href="{{ route('events.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-indigo-500 text-white font-semibold rounded-lg 
                                       hover:bg-indigo-400 transition border-2 border-white">
                                Buat Event
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>


        {{-- ======================= FILTER SECTION ======================= --}}
        <div id="events" class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <form action="{{ route('events.index') }}" method="GET">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    {{-- Search --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cari Event</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari judul event..."
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->icon }} {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Event Type --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Event</label>
                        <select name="event_type_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Tipe</option>
                            @foreach($eventTypes as $type)
                                <option value="{{ $type->id }}" 
                                    {{ request('event_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Row 2 --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">

                    {{-- Venue Type --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <select name="venue_type" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Lokasi</option>
                            <option value="online"  {{ request('venue_type') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ request('venue_type') == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="hybrid"  {{ request('venue_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    {{-- Price --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                        <select name="price_filter" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Harga</option>
                            <option value="free" {{ request('price_filter') == 'free' ? 'selected' : '' }}>Gratis</option>
                            <option value="paid" {{ request('price_filter') == 'paid' ? 'selected' : '' }}>Berbayar</option>
                        </select>
                    </div>

                    {{-- Sort --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                        <select name="sort_by" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="start_date"        {{ request('sort_by') == 'start_date' ? 'selected' : '' }}>Tanggal Mulai</option>
                            <option value="created_at"        {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price"             {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
                            <option value="registered_count"  {{ request('sort_by') == 'registered_count' ? 'selected' : '' }}>Paling Populer</option>
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-end space-x-2">
                        <button type="submit" 
                                class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                            Filter
                        </button>
                        <a href="{{ route('events.index') }}" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
<form action="{{ route('events.index') }}" method="GET" id="filterForm">
    <select name="category_id" 
            onchange="this.form.submit()" 
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        
        <option value="">Semua Kategori</option>
        
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->icon }} {{ $category->name }}
            </option>
        @endforeach
    </select>
    
    
    </form>

        {{-- ======================= EVENT LIST ======================= --}}
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

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $events->links() }}
            </div>

        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada event ditemukan</h3>
                <p class="mt-2 text-gray-600">Coba ubah filter atau kata kunci pencarian Anda.</p>

                <a href="{{ route('events.index') }}" 
                   class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Lihat Semua Event
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
