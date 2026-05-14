<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $shot->title }}</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#f8f7f4]">

<div class="max-w-7xl mx-auto px-8 py-10">

    <!-- TITLE -->
    <h1 class="text-5xl font-bold text-[#0d0c22] mb-10">
        {{ $shot->title }}
    </h1>

    <!-- TOP -->
    <div class="flex items-center justify-between mb-10">

        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-full bg-pink-200"></div>

            <div>
                <h2 class="font-bold text-2xl">
                    {{ $shot->user->username }}
                </h2>

                <p class="text-gray-500">
                    Available for work
                </p>
            </div>

        </div>

        <!-- BUTTON -->
        <div>

            @if(auth()->check())

                <button class="bg-[#0d0c22] text-white px-8 py-4 rounded-full font-semibold">
                    Get in touch
                </button>

            @else

                <a
                    href="{{ route('login') }}"
                    class="bg-[#0d0c22] text-white px-8 py-4 rounded-full font-semibold"
                >
                    Get in touch
                </a>

            @endif

        </div>

    </div>

    <!-- IMAGE -->
    <div class="mb-12">

        <img
            src="{{ $shot->image_url }}"
            class="w-full rounded-3xl"
        >

    </div>

    <!-- DESCRIPTION -->
    <div class="max-w-4xl mx-auto">

        <p class="text-3xl leading-relaxed text-[#0d0c22]">
            {{ $shot->description }}
        </p>

    </div>

</div>

</body>
</html>