<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ImpactHub') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background: linear-gradient(135deg, #01162b 0%, #00385a 50%, #6a90b4 100%);
                min-height: 100vh;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <!-- Logo -->
            <div class="mb-8">
                <a href="/" class="flex items-center space-x-3">
                    <div class="bg-gradient-to-br from-[#6a90b4] to-[#94a2bf] w-16 h-16 rounded-xl flex items-center justify-center shadow-2xl">
                        <i class="fas fa-heart text-white text-3xl"></i>
                    </div>
                    <div>
                        <span class="text-3xl font-bold text-white">ImpactHub</span>
                        <p class="text-sm text-[#d2dbcb]">Wujudkan Dampak Positif</p>
                    </div>
                </a>
            </div>

            <!-- Card -->
            <div class="w-full sm:max-w-md">
                <div class="bg-white/95 backdrop-blur-md shadow-2xl rounded-2xl overflow-hidden border border-white/20">
                    <div class="px-8 py-6">
                        {{ $slot }}
                    </div>
                </div>
                
                <!-- Back to Home -->
                <div class="text-center mt-6">
                    <a href="/" class="text-white hover:text-[#d2dbcb] transition text-sm inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
