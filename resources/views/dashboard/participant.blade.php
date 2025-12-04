<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Participant Dashboard</h2>
    </x-slot>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-gray-600 mt-2">Track your learning journey and achievements</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Registrations -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">My Events</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_registrations'] }}</h3>
                    <p class="text-blue-100 text-xs mt-2">
                        <span class="font-semibold">{{ $stats['confirmed_registrations'] }}</span> Confirmed
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Certificates -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Certificates</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_certificates'] }}</h3>
                    <p class="text-green-100 text-xs mt-2">
                        Earned so far
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Points -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm font-medium">Total Points</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_points'] }}</h3>
                    <p class="text-amber-100 text-xs mt-2">
                        Keep earning!
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completion Rate -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Completion Rate</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['confirmed_registrations'] > 0 ? number_format(($stats['total_certificates'] / $stats['confirmed_registrations']) * 100, 0) : 0 }}%</h3>
                    <p class="text-purple-100 text-xs mt-2">
                        Great progress!
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- My Registrations -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">My Events</h2>
                <a href="{{ route('registrations.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">View All →</a>
            </div>

            <div class="space-y-4">
                @forelse($myRegistrations as $registration)
                    <div class="flex items-start space-x-4 p-4 border border-gray-200 rounded-xl hover:border-indigo-300 hover:shadow-md transition group">
                        <!-- Event Image -->
                        <div class="flex-shrink-0">
                            @if($registration->event->image)
                                <img src="{{ asset('storage/' . $registration->event->image) }}" class="h-20 w-20 rounded-lg object-cover" alt="{{ $registration->event->title }}">
                            @else
                                <div class="h-20 w-20 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Event Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-base font-semibold text-gray-900 group-hover:text-indigo-600 transition truncate">
                                        {{ $registration->event->title }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $registration->event->eventType->name }} • {{ $registration->event->category->name }}
                                    </p>
                                </div>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $registration->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($registration->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </div>

                            <div class="flex items-center space-x-4 mt-3">
                                <span class="text-xs text-gray-500 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $registration->event->start_date->format('d M Y') }}
                                </span>
                                @if($registration->event->location)
                                    <span class="text-xs text-gray-500 flex items-center truncate">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ Str::limit($registration->event->location, 20) }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center space-x-2 mt-3">
                                <a href="{{ route('registrations.show', $registration) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No events yet</h3>
                        <p class="mt-2 text-gray-600">Start exploring and join events to boost your skills!</p>
                        <a href="{{ route('events.index') }}" class="mt-4 inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                            Explore Events
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Recommended Events -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Recommended for You</h3>
                
                <div class="space-y-4">
                    @forelse($recommendedEvents as $event)
                        <div class="group cursor-pointer">
                            <a href="{{ route('events.show', $event->slug) }}" class="block">
                                <div class="relative h-32 rounded-lg overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 mb-3">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" alt="{{ $event->title }}">
                                    @endif
                                    @if($event->isFree())
                                        <span class="absolute top-2 right-2 px-2 py-1 bg-green-500 text-white text-xs font-bold rounded-full">
                                            FREE
                                        </span>
                                    @endif
                                </div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 text-sm">
                                    {{ $event->title }}
                                </h4>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $event->category->icon }} {{ $event->category->name }}
                                </p>
                            </a>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">No recommendations yet</p>
                    @endforelse
                </div>
            </div>

            <!-- Achievement Badge -->
            <div class="bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold">Your Level</h3>
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                
                @php
                    $level = floor($stats['total_points'] / 500) + 1;
                    $nextLevelPoints = $level * 500;
                    $progress = (($stats['total_points'] % 500) / 500) * 100;
                @endphp
                
                <div class="text-center mb-4">
                    <div class="text-4xl font-bold">Level {{ $level }}</div>
                    <p class="text-amber-100 text-sm mt-1">
                        @if($level <= 3)
                            Beginner
                        @elseif($level <= 7)
                            Intermediate
                        @else
                            Expert
                        @endif
                    </p>
                </div>
                
                <div class="bg-white/20 rounded-full h-3 mb-2 overflow-hidden">
                    <div class="bg-white h-full rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                </div>
                <p class="text-xs text-amber-100 text-center">
                    {{ $nextLevelPoints - $stats['total_points'] }} points to Level {{ $level + 1 }}
                </p>
            </div>

        </div>
    </div>

</div>
</x-app-layout>