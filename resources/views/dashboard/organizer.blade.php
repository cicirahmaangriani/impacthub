<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Organizer Dashboard ImpactHUB</h1>
            <p class="text-gray-600 mt-2">Kelola event dan pantau performa Anda 📊</p>
        </div>
        <a href="{{ route('events.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-6 rounded-lg font-semibold hover:shadow-lg transition">
            + Buat Event Baru
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Events -->
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-sm font-medium">Total Events</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_events'] }}</h3>
                    <p class="text-indigo-100 text-xs mt-2">
                        <span class="font-semibold">{{ $stats['published_events'] }}</span> Published
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Participants -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Participants</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_participants'] }}</h3>
                    <p class="text-green-100 text-xs mt-2">
                        Across all your events
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Earnings -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm font-medium">Total Earnings</p>
                    <h3 class="text-3xl font-bold mt-2">Rp {{ number_format($stats['total_earnings'], 0, ',', '.') }}</h3>
                    <p class="text-amber-100 text-xs mt-2">
                        After platform fee (10%)
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Avg Rating -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Event Success Rate</p>
                    <h3 class="text-3xl font-bold mt-2">{{ number_format(($stats['published_events'] / max($stats['total_events'], 1)) * 100, 1) }}%</h3>
                    <p class="text-purple-100 text-xs mt-2">
                        Published vs Draft
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- My Events -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900">My Events</h2>
            <div class="flex space-x-2">
                <button class="px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                    All
                </button>
                <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    Published
                </button>
                <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    Draft
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($myEvents as $event)
                <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition group">
                    <!-- Image -->
                    <div class="relative h-48 bg-gradient-to-br from-indigo-500 to-purple-600">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover" alt="{{ $event->title }}">
                        @else
                            <div class="flex items-center justify-center h-full text-white">
                                <svg class="h-16 w-16 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $event->status === 'published' ? 'bg-green-500' : ($event->status === 'draft' ? 'bg-yellow-500' : 'bg-gray-500') }} text-white">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $event->eventType->name }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $event->category->icon }} {{ $event->category->name }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition">
                            {{ $event->title }}
                        </h3>

                        <!-- Stats -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="text-center">
                                <p class="text-lg font-bold text-indigo-600">{{ $event->registrations_count ?? $event->registered_count }}</p>
                                <p class="text-xs text-gray-500">Peserta</p>
                            </div>
                            <div class="text-center">
                                <p class="text-lg font-bold text-green-600">
                                    @if($event->price > 0)
                                        Rp {{ number_format($event->price, 0, ',', '.') }}
                                    @else
                                        Free
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500">Harga</p>
                            </div>
                            <div class="text-center">
                                <p class="text-lg font-bold text-amber-600">{{ $event->start_date->format('d M') }}</p>
                                <p class="text-xs text-gray-500">Mulai</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-2 mt-4">
                            <a href="{{ route('events.show', $event->slug) }}" class="flex-1 text-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                                View
                            </a>
                            <a href="{{ route('events.edit', $event->id) }}" class="flex-1 text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No events yet</h3>
                    <p class="mt-2 text-gray-600">Get started by creating your first event.</p>
                    <a href="{{ route('events.create') }}" class="mt-4 inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Your First Event
                    </a>
                </div>
            @endforelse
        </div>
    </div>

</div>
</x-app-layout>