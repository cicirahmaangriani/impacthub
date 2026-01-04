<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Reports & Analytics</h1>
                <p class="text-gray-600 mt-1">Overview statistik dan performa platform</p>
            </div>
        </div>

        <!-- Overview Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Users</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_users']) }}</h3>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Events -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Events</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_events']) }}</h3>
                        <p class="text-xs text-green-600 mt-1">{{ $stats['published_events'] }} Published</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Registrations -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Registrations</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_registrations']) }}</h3>
                        <p class="text-xs text-green-600 mt-1">{{ $stats['confirmed_registrations'] }} Confirmed</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Revenue</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                        <p class="text-xs text-yellow-600 mt-1">Rp {{ number_format($stats['pending_revenue'], 0, ',', '.') }} Pending</p>
                    </div>
                    <div class="p-3 bg-amber-100 rounded-full">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top Events -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Top 5 Events by Registration</h2>
                <div class="space-y-3">
                    @forelse($topEvents as $event)
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $event->title }}</p>
                                <p class="text-xs text-gray-500">{{ $event->category->name ?? '-' }}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $event->registrations_count }} registrations
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Tidak ada data</p>
                    @endforelse
                </div>
            </div>

            <!-- Events by Category -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Events by Category</h2>
                <div class="space-y-3">
                    @forelse($eventsByCategory as $item)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">{{ $item->category->name ?? 'Uncategorized' }}</span>
                            <div class="flex items-center gap-2">
                                <div class="w-32 bg-gray-200 rounded-full h-2">
                                    <div class="bg-ocean-500 h-2 rounded-full" style="width: {{ ($item->total / $stats['total_events']) * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 w-8 text-right">{{ $item->total }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Tidak ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Trend -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Revenue Trend (6 Months)</h2>
                <div class="space-y-2">
                    @forelse($revenueByMonth as $item)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->month . '-01')->format('M Y') }}</span>
                            <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Tidak ada data</p>
                    @endforelse
                </div>
            </div>

            <!-- User Growth -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">User Growth (6 Months)</h2>
                <div class="space-y-2">
                    @forelse($userGrowth as $item)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->month . '-01')->format('M Y') }}</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $item->total }} new users</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Tidak ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Users by Role -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Users by Role</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($usersByRole as $item)
                    <div class="p-4 rounded-lg {{ $item->role === 'admin' ? 'bg-red-50' : ($item->role === 'organizer' ? 'bg-blue-50' : 'bg-green-50') }}">
                        <p class="text-sm font-medium {{ $item->role === 'admin' ? 'text-red-700' : ($item->role === 'organizer' ? 'text-blue-700' : 'text-green-700') }}">
                            {{ ucfirst($item->role) }}
                        </p>
                        <p class="text-2xl font-bold {{ $item->role === 'admin' ? 'text-red-900' : ($item->role === 'organizer' ? 'text-blue-900' : 'text-green-900') }} mt-1">
                            {{ $item->total }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Registrations -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Registrations</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="py-2">User</th>
                            <th class="py-2">Event</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($recentRegistrations as $reg)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2">{{ $reg->user->name ?? '-' }}</td>
                                <td class="py-2">{{ $reg->event->title ?? '-' }}</td>
                                <td class="py-2">
                                    <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $reg->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($reg->status) }}
                                    </span>
                                </td>
                                <td class="py-2 text-gray-600">{{ $reg->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
