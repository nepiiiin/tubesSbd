<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --dribbble-pink: #ea4c89;
            --dribbble-pink-hover: #c73e72;
            --dribbble-dark: #0d0c22;
            --dribbble-bg: #f8f7f4;
        }

        html {
            color-scheme: light !important;
        }

        body {
            background-color: var(--dribbble-bg);
            color: var(--dribbble-dark);
        }

        .bg-dribbble-pink {
            background-color: #ea4c89 !important;
        }

        .hover\:bg-dribbble-pink:hover {
            background-color: #c73e72 !important;
        }

        .text-dribbble-pink {
            color: #ea4c89 !important;
        }

        .border-dribbble-pink {
            border-color: #ea4c89 !important;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="font-sans antialiased bg-[#f8f7f4] text-[#0d0c22]">

    <div class="min-h-screen bg-[#f8f7f4]">

        @include('layouts.navigation')

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-4 max-w-7xl mx-auto mt-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-4 max-w-7xl mx-auto mt-4">
                {{ session('error') }}
            </div>
        @endif

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </main>

    </div>

    <x-footer />

</body>
</html>