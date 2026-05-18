<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $shot->title }}</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#f8f7f4] text-[#0d0c22]">

<div class="max-w-7xl mx-auto px-6 lg:px-10 py-10">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-10">

        <div class="flex items-center gap-4">

            <!-- AVATAR -->
            <img
                src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username ?? 'U') }}"
                class="w-14 h-14 rounded-full object-cover"
            >

            <div>

                <h1 class="text-3xl font-bold">
                    {{ $shot->title }}
                </h1>

                <p class="text-gray-500 mt-1">
                    {{ $shot->user->username ?? 'Unknown User' }}
                </p>

            </div>

        </div>

        <!-- BUTTONS -->
        <div class="flex items-center gap-3">

            <a
                href="{{ url()->previous() }}"
                class="px-6 py-3 rounded-full border border-gray-300 hover:bg-white transition"
            >
                Back
            </a>

            @if(auth()->check())

                <button class="bg-[#0d0c22] text-white px-8 py-3 rounded-full font-semibold hover:opacity-90">
                    Get in touch
                </button>

            @else

                <a
                    href="{{ route('login') }}"
                    class="bg-[#0d0c22] text-white px-8 py-3 rounded-full font-semibold hover:opacity-90"
                >
                    Get in touch
                </a>

            @endif

        </div>

    </div>

    <!-- MAIN -->
    <div class="grid lg:grid-cols-3 gap-10">

        <!-- LEFT -->
        <div class="lg:col-span-2">

            <!-- IMAGE -->
            <div class="bg-white rounded-[32px] p-4 shadow-sm">

                <img
                    src="{{ $shot->image_url }}"
                    alt="{{ $shot->title }}"
                    class="w-full rounded-[28px]"
                >

            </div>

            <!-- DESCRIPTION -->
            <div class="mt-10 bg-white rounded-[32px] p-8 shadow-sm">

                <h2 class="text-2xl font-bold mb-5">
                    Description
                </h2>

                <p class="text-gray-600 leading-8 text-lg whitespace-pre-line">
                    {{ $shot->description }}
                </p>

            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div>

            <!-- STATS -->
            <div class="bg-white rounded-[32px] p-7 shadow-sm">

                <h3 class="text-xl font-bold mb-6">
                    Project Stats
                </h3>

                <div class="space-y-5">

                    <div class="flex items-center justify-between">
                        <span class="text-gray-500">Likes</span>
                        <span class="font-semibold">
                            ❤️ {{ $shot->likes_count }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-gray-500">Posted</span>
                        <span class="font-semibold">
                            {{ $shot->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-gray-500">Categories</span>
                        <span class="font-semibold">
                            {{ $shot->categories->count() }}
                        </span>
                    </div>

                </div>

            </div>

            <!-- CATEGORIES -->
            <div class="bg-white rounded-[32px] p-7 shadow-sm mt-6">

                <h3 class="text-xl font-bold mb-5">
                    Categories
                </h3>

                <div class="flex flex-wrap gap-2">

                    @foreach($shot->categories as $category)

                        <span class="px-4 py-2 bg-gray-100 rounded-full text-sm text-gray-600">
                            {{ $category->name }}
                        </span>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>