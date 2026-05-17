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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="font-sans antialiased bg-white text-gray-900 dark:bg-[#071025] dark:text-white transition-colors duration-300">

    <div class="min-h-screen bg-[#f8f7f4] dark:bg-[#071025] transition-colors duration-300">

        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)

            <header class="bg-white dark:bg-[#0f172a] shadow transition-colors duration-300">

                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                    {{ $header }}

                </div>

            </header>

        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

    </div>

    <x-footer />

    <!-- AUTO DARK MODE -->
    <script>

        if (
            localStorage.theme === 'dark' ||
            (
                !('theme' in localStorage) &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            )
        ) {

            document.documentElement.classList.add('dark')

        } else {

            document.documentElement.classList.remove('dark')

        }

    </script>

</body>
</html>