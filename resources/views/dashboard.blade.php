<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-ocean-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-ocean-900 to-ocean-800 overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-6 text-ocean-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
