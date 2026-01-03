<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f7f2 0%, #e8ede3 25%, #d2dbcb 50%, #c5d0bf 100%);
            min-height: 100vh;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 56, 90, 0.1);
            box-shadow: 0 8px 32px rgba(1, 22, 43, 0.1);
        }
        
        .btn-ocean {
            background: #00385a;
            color: white;
            box-shadow: 0 10px 30px rgba(1, 22, 43, 0.25);
            transition: all 0.3s ease;
        }
        
        .btn-ocean:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(1, 22, 43, 0.35);
            background: #01162b;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #01162b 0%, #00385a 50%, #6a90b4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen" style="background: linear-gradient(135deg, #f5f7f2 0%, #e8ede3 25%, #d2dbcb 50%, #c5d0bf 100%);">
        @include('layouts.navigation')

        {{-- Header: support slot & section --}}
        @if (isset($header))
            <header class="shadow-lg" style="background: rgba(0, 56, 90, 0.98); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(106, 144, 180, 0.2); position: relative; z-index: 100;">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-white">
                    {{ $header }}
                </div>
            </header>
        @elseif (View::hasSection('header'))
            <header class="shadow-lg" style="background: rgba(0, 56, 90, 0.98); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(106, 144, 180, 0.2); position: relative; z-index: 100;">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-white">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Content: support slot & section --}}
        <main class="py-6">
            @isset($slot)
                {{ $slot }}
            @endisset

            @yield('content')
        </main>
    </div>

    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>
</body>
</html>
