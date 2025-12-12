<x-app-layout>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ auth()->user()->name }}! 👋</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Users</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_users'] }}</h3>
                    <p class="text-blue-100 text-xs mt-2">
                        <span class="font-semibold">{{ \App\Models\User::organizers()->count() }}</span> Organizers, 
                        <span class="font-semibold">{{ \App\Models\User::participants()->count() }}</span> Participants
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Events -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Events</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_events'] }}</h3>
                    <p class="text-purple-100 text-xs mt-2">
                        <span class="font-semibold">{{ \App\Models\Event::published()->count() }}</span> Published
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Registrations -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Registrations</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_registrations'] }}</h3>
                    <p class="text-green-100 text-xs mt-2">
                        <span class="font-semibold">{{ \App\Models\Registration::confirmed()->count() }}</span> Confirmed
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

        <!-- Total Revenue -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm font-medium">Total Revenue</p>
                    <h3 class="text-3xl font-bold mt-2">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                    <p class="text-amber-100 text-xs mt-2">
                        From {{ \App\Models\Transaction::paid()->count() }} transactions
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
    </div>

    <!-- Recent Events & Registrations -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        <!-- Recent Events -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Recent Events</h2>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">View All →</a>
            </div>
            
            <div class="space-y-4">
                @forelse($recentEvents as $event)
                    <div class="flex items-start space-x-4 p-4 hover:bg-gray-50 rounded-lg transition">
                        <div class="flex-shrink-0">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="h-16 w-16 rounded-lg object-cover" alt="{{ $event->title }}">
                            @else
                                <div class="h-16 w-16 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $event->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">by {{ $event->user->name }}</p>
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $event->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $event->registered_count }}/{{ $event->quota }} peserta
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('events.show', $event->slug) }}" class="flex-shrink-0 text-indigo-600 hover:text-indigo-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="mt-2">No events yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Registrations -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Recent Registrations</h2>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">View All →</a>
            </div>
            
            <div class="space-y-4">
                @forelse($recentRegistrations as $registration)
                    <div class="flex items-start space-x-4 p-4 hover:bg-gray-50 rounded-lg transition">
                        <img src="{{ $registration->user->avatar_url }}" class="h-10 w-10 rounded-full" alt="{{ $registration->user->name }}">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900">{{ $registration->user->name }}</p>
                            <p class="text-xs text-gray-500 truncate mt-1">
                                {{ $registration->event->title ?? 'Event Deleted' }}
                            </p>

                            <div class="flex items-center space-x-2 mt-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $registration->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($registration->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $registration->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="mt-2">No registrations yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#" class="flex flex-col items-center p-6 border-2 border-gray-200 rounded-xl hover:border-indigo-500 hover:shadow-md transition group">
                <div class="h-12 w-12 bg-indigo-100 rounded-full flex items-center justify-center group-hover:bg-indigo-600 transition">
                    <svg class="h-6 w-6 text-indigo-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="mt-3 text-sm font-medium text-gray-900">Create Event</span>
            </a>
            
            <a href="#" class="flex flex-col items-center p-6 border-2 border-gray-200 rounded-xl hover:border-purple-500 hover:shadow-md transition group">
                <div class="h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center group-hover:bg-purple-600 transition">
                    <svg class="h-6 w-6 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="mt-3 text-sm font-medium text-gray-900">Manage Users</span>
            </a>
            
            <a href="#" class="flex flex-col items-center p-6 border-2 border-gray-200 rounded-xl hover:border-green-500 hover:shadow-md transition group">
                <div class="h-12 w-12 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-600 transition">
                    <svg class="h-6 w-6 text-green-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <span class="mt-3 text-sm font-medium text-gray-900">View Reports</span>
            </a>
            
            <a href="#" class="flex flex-col items-center p-6 border-2 border-gray-200 rounded-xl hover:border-amber-500 hover:shadow-md transition group">
                <div class="h-12 w-12 bg-amber-100 rounded-full flex items-center justify-center group-hover:bg-amber-600 transition">
                    <svg class="h-6 w-6 text-amber-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="mt-3 text-sm font-medium text-gray-900">Settings</span>
            </a>
        </div>
    </div>

</div>
</x-app-layout>