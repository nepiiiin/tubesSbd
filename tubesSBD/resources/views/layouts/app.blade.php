<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dribbble Clone</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f8f7f4] text-gray-900">

    <nav class="bg-white border-b border-gray-200 px-10 py-5 flex items-center justify-between">

        <div class="flex items-center gap-10">

            <h1 class="text-3xl font-bold text-pink-500">
                Dribbble
            </h1>

            <div class="flex gap-6 text-sm font-medium">

                <a href="/" class="hover:text-pink-500">
                    Discover
                </a>

                <a href="/explore" class="hover:text-pink-500">
                    Explore
                </a>

            </div>

        </div>

        <div class="flex items-center gap-4">

            <input
                type="text"
                placeholder="Search..."
                class="bg-gray-100 px-4 py-2 rounded-full outline-none w-64"
            >

            <a
                href="/login"
                class="font-medium hover:text-pink-500"
            >
                Login
            </a>

            <a
                href="/register"
                class="bg-pink-500 text-white px-5 py-2 rounded-full hover:bg-pink-600"
            >
                Sign Up
            </a>

        </div>

    </nav>

    <main class="px-10 py-8">
        @yield('content')
    </main>

</body>
</html>