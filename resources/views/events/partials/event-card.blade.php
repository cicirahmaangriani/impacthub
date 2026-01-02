<div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
    
    {{-- IMAGE --}}
    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600">
        @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" 
                 alt="{{ $event->title }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
        @else
            <div class="flex items-center justify-center h-full text-white">
                <svg class="h-20 w-20 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif

        {{-- FEATURED --}}
        @if($event->is_featured)
            <div class="absolute top-3 left-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-400 text-yellow-900">
                    ⭐ Featured
                </span>
            </div>
        @endif

        {{-- CATEGORY --}}
        <div class="absolute top-3 right-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/90 text-gray-900 backdrop-blur-sm">
                {{ $event->category->icon }} {{ $event->category->name }}
            </span>
        </div>

        {{-- PRICE --}}
        <div class="absolute bottom-3 right-3">
            @if($event->isFree())
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-500 text-white">
                    GRATIS
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-indigo-600 text-white">
                    Rp {{ number_format($event->price, 0, ',', '.') }}
                </span>
            @endif
        </div>
    </div>


    {{-- CONTENT --}}
    <div class="p-5">

        {{-- Event Type & Venue --}}
        <div class="flex items-center space-x-2 mb-3">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                {{ $event->eventType->name }}
            </span>

            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                {{ $event->venue_type === 'online' 
                    ? 'bg-blue-100 text-blue-800' 
                    : ($event->venue_type === 'offline' 
                        ? 'bg-orange-100 text-orange-800' 
                        : 'bg-teal-100 text-teal-800') }}">
                @switch($event->venue_type)
                    @case('online') 🌐 Online @break
                    @case('offline') 📍 Offline @break
                    @default 🔄 Hybrid
                @endswitch
            </span>
        </div>

        {{-- Title --}}
        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition">
            <a href="{{ route('events.show', $event->slug) }}">
                {{ $event->title }}
            </a>
        </h3>

        {{-- Description --}}
        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
            {{ Str::limit($event->description, 100) }}
        </p>

        {{-- META --}}
        <div class="space-y-2 mb-4">

            {{-- Date --}}
            <div class="flex items-center text-sm text-gray-600">
                <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $event->start_date->format('d M Y') }}
            </div>

            {{-- Location --}}
            @if($event->location)
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="line-clamp-1">{{ Str::limit($event->location, 30) }}</span>
                </div>
            @endif

            {{-- Organizer --}}
            <div class="flex items-center text-sm text-gray-600">
                <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                {{ $event->user->name }}
            </div>

        </div>


        {{-- Participants --}}
        <div class="mb-4">
            <div class="flex items-center justify-between text-sm mb-1">
                <span class="text-gray-600">Peserta</span>
                <span class="font-semibold text-gray-900">
                    {{ $event->registered_count }}/{{ $event->quota }}
                </span>
            </div>

            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-indigo-600 h-2 rounded-full transition-all"
                     style="width: {{ $event->quota > 0 ? ($event->registered_count / $event->quota) * 100 : 0 }}%">
                </div>
            </div>

            <p class="text-xs text-gray-500 mt-1">
                @if($event->available_slots > 0)
                    {{ $event->available_slots }} slot tersisa
                @else
                    <span class="text-red-600 font-semibold">Penuh!</span>
                @endif
            </p>

            <div class="flex items-center justify-between text-sm mb-1">
                <span class="text-gray-600">Point Reward</span>
                <span class="font-semibold text-gray-900">
                    {{ $event->point_reward }}/{{ $event->quota }}
                </span>
            </div>
             
        </div>


        {{-- FOOTER BUTTONS --}}
        <div class="flex items-center justify-between pt-4 border-t border-gray-200">  
            <a href="{{ route('events.show', $event->slug) }}"
               class="w-full bg-current hover:bg-mist text-white py-3 rounded-lg font-semibold transition text-center">
                Lihat Detail
            </a>

        </div>
            
    </div>
</div>
