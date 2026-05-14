<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Profile</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f8f7f4] text-[#0d0c22]">

<!-- NAVBAR -->
<nav class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">

    <a href="/" class="text-3xl font-bold text-pink-500">
        Dribbble
    </a>

    <a href="/"
       class="bg-[#0d0c22] text-white px-5 py-2 rounded-full text-sm font-medium">
        Back
    </a>

</nav>

<!-- PROFILE HEADER -->
<section class="max-w-6xl mx-auto px-6 py-14">

    <div class="flex flex-col items-center text-center">

        <!-- PHOTO -->
        @if($user->profile_photo)

            <img
                src="{{ asset('storage/' . $user->profile_photo) }}"
                class="w-32 h-32 rounded-full object-cover"
            >

        @else

            <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-14 h-14 text-white"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                    />

                </svg>

            </div>

        @endif

        <!-- NAME -->
        <h1 class="text-4xl font-bold mt-6">
            {{ $user->name }}
        </h1>

        <!-- USERNAME -->
        <p class="text-gray-500 mt-2 text-lg">
            @{{ $user->username }}
        </p>

        <!-- BIO -->
        <p class="text-gray-600 mt-5 max-w-2xl leading-relaxed">
            {{ $user->bio ?? 'No bio yet.' }}
        </p>

    </div>

</section>

<!-- POSTS -->
<section class="max-w-7xl mx-auto px-6 pb-20">

    <h2 class="text-2xl font-bold mb-8">
        Shots
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        @foreach($posts as $post)

        <a href="/posts/{{ $post->id }}" class="group block">

            <div class="overflow-hidden rounded-2xl bg-gray-100">

                <img
                    src="{{ $post->image }}"
                    class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                >

            </div>

            <div class="mt-3">

                <h3 class="font-semibold">
                    {{ $post->title }}
                </h3>

            </div>

        </a>

        @endforeach

    </div>

</section>

</body>
</html>