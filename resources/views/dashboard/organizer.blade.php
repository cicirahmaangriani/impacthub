<x-app-layout>
<div class="min-h-screen bg-veil">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header -->
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-abyss">
                Organizer Dashboard ImpactHUB
            </h1>
            <p class="text-frost mt-2">
                Kelola event dan pantau performa Anda
            </p>
        </div>
        <a href="{{ route('events.create') }}"
           class="bg-current hover:bg-abyss text-white py-3 px-6 rounded-lg font-semibold transition shadow">
            + Buat Event Baru
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <!-- Card -->
        @php
        $statCards = [
            ['label'=>'Total Events','value'=>$stats['total_events'],'sub'=>$stats['published_events'].' Published'],
            ['label'=>'Total Participants','value'=>$stats['total_participants'],'sub'=>'Across all events'],
            ['label'=>'Total Earnings','value'=>'Rp '.number_format($stats['total_earnings'],0,',','.'),'sub'=>'After platform fee'],
            ['label'=>'Event Success Rate','value'=>number_format(($stats['published_events']/max($stats['total_events'],1))*100,1).'%','sub'=>'Published vs Draft'],
        ];
        @endphp

        @foreach($statCards as $card)
        <div class="bg-gradient-to-br from-abyss to-current rounded-2xl p-6 shadow-xl text-white">
            <p class="text-frost text-sm font-medium">{{ $card['label'] }}</p>
            <h3 class="text-3xl font-bold mt-2 text-white">{{ $card['value'] }}</h3>
            <p class="text-mist text-xs mt-2">{{ $card['sub'] }}</p>
        </div>
        @endforeach

    </div>

    <!-- My Events -->
    <div class="bg-white rounded-2xl shadow p-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-abyss">My Events</h2>
            <div class="flex space-x-2">
                @foreach([''=>'All','published'=>'Published','draft'=>'Draft'] as $key=>$label)
                <a href="{{ route('dashboard', $key ? ['filter'=>$key] : []) }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition
                   {{ ($filter ?? '') === $key ? 'bg-current text-white' : 'text-current hover:bg-veil' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($myEvents as $event)
            <div onclick="window.location='{{ route('events.show',$event->slug) }}'" role="button" tabindex="0" class="border border-veil rounded-xl overflow-hidden bg-white hover:shadow-lg transition cursor-pointer">

                <!-- Image -->
                <div class="relative h-48 bg-gradient-to-br from-abyss to-current">
                    @if($event->image)
                        <img src="{{ asset('storage/'.$event->image) }}"
                             class="w-full h-full object-cover" alt="{{ $event->title }}">
                    @endif

                    <!-- Status -->
                    <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold
                        {{ $event->status === 'published'
                            ? 'bg-current text-white'
                            : 'bg-veil text-abyss' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <!-- Content -->
                <div class="p-5">
                    <h3 class="text-lg font-bold text-abyss mb-2">
                        {{ $event->title }}
                    </h3>

                    <div class="flex justify-between text-sm mt-4 border-t border-veil pt-4">
                        <div class="text-center">
                            <p class="font-bold text-current">
                                {{ $event->registrations_count ?? $event->registered_count }}
                            </p>
                            <p class="text-frost text-xs">Peserta</p>
                        </div>
                        <div class="text-center">
                            <p class="font-bold text-current">
                                {{ $event->price > 0 ? 'Rp '.number_format($event->price,0,',','.') : 'Free' }}
                            </p>
                            <p class="text-frost text-xs">Harga</p>
                        </div>
                        <div class="text-center">
                            <p class="font-bold text-current">
                                {{ $event->start_date->format('d M') }}
                            </p>
                            <p class="text-frost text-xs">Mulai</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('events.edit',$event->slug) }}"
                           onclick="event.stopPropagation()"
                           class="flex-1 text-center border border-current bg-current text-white rounded-lg py-2 hover:bg-abyss transition">
                            Edit
                        </a>
                        <a href="{{ route('events.hapus',$event->slug) }}"
                           onclick="event.stopPropagation(); return confirm('Yakin ingin menghapus event ini?');"
                           class="flex-1 text-center border border-current text-current rounded-lg py-2 hover:bg-mist hover:text-white transition">
                            Hapus
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
</div>
</x-app-layout>
