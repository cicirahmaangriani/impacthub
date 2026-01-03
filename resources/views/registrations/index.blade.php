{{-- resources/views/registrations/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Registrasi Event')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold gradient-text">Daftar Registrasi</h1>

        @if(request('event'))
            <a href="{{ route('events.show', request('event')) }}"
               class="font-medium transition-all duration-300" style="color: #00385a;" onmouseover="this.style.color='#6a90b4'" onmouseout="this.style.color='#00385a'">
                ← Kembali ke Event
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="glass-card rounded-2xl p-6 transform transition-all duration-300 hover:shadow-2xl">
        @if(isset($registrations) && count($registrations))
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b" style="color: #00385a;">
                            <th class="py-3 pr-4">Nama</th>
                            <th class="py-3 pr-4">Email</th>
                            <th class="py-3 pr-4">Event</th>
                            <th class="py-3 pr-4">Status</th>
                            <th class="py-3 pr-4">Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($registrations as $r)
                            <tr>
                                <td class="py-3 pr-4 font-medium" style="color: #01162b;">
                                    {{ $r->user->name ?? '-' }}
                                </td>
                                <td class="py-3 pr-4" style="color: #00385a;">
                                    {{ $r->user->email ?? '-' }}
                                </td>
                                <td class="py-3 pr-4" style="color: #00385a;">
                                    {{ $r->event->title ?? '-' }}
                                </td>
                                <td class="py-3 pr-4">
                                    <span class="px-2 py-1 rounded-full text-white" style="background: #6a90b4;">
                                        {{ $r->status ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-3 pr-4" style="color: #00385a;">
                                    {{ optional($r->created_at)->format('d M Y, H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-gray-600">
                Belum ada registrasi.
            </div>
        @endif
    </div>
</div>
@endsection
