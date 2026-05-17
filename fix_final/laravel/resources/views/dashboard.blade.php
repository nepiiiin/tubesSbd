<x-app-layout>

<div x-data="{ open:false, selectedShot:null }">

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 p-6">

    @foreach($shots as $shot)

    <div
        @click="
            open = true;
            selectedShot = {
                id: {{ $shot->id }},
                liked: false,
                title: '{{ addslashes($shot->title) }}',
                image: '{{ $shot->image_url }}',
                user: '{{ addslashes($shot->user->username) }}',
                description: '{{ addslashes($shot->description) }}'
            }
        "
        class="cursor-pointer"
    >

        <div class="group">

            <!-- IMAGE -->
            <div class="overflow-hidden rounded-2xl bg-gray-100 dark:bg-[#0f172a]">

                <img
                    src="{{ $shot->image_url }}"
                    alt="{{ $shot->title }}"
                    onerror="this.src='https://placehold.co/600x400?text=No+Image'"
                    class="w-full h-[350px] object-cover hover:scale-105 transition duration-300"
                >

            </div>

            <!-- INFO -->
            <div class="flex items-center justify-between mt-3">

                <div class="flex items-center gap-3">

                    <!-- AVATAR -->
                    <img
                        src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username) }}"
                        class="w-8 h-8 rounded-full object-cover"
                    >

                    <div>

                        <h3 class="font-semibold text-sm text-gray-900 dark:text-white">
                            {{ $shot->title }}
                        </h3>

                        <p class="text-xs text-gray-500 dark:text-slate-300">
                            {{ $shot->user->username ?? 'Unknown' }}
                        </p>

                    </div>

                    <div class="flex flex-wrap gap-2 mt-1">

                        @foreach($shot->categories as $category)

                            <span class="text-[11px] px-2 py-1 bg-pink-500 rounded-full text-white">

                                {{ $category->name }}

                            </span>

                        @endforeach

                    </div>

                </div>

                <!-- LIKES -->
                <div class="flex items-center gap-1 text-gray-500 dark:text-slate-300 text-sm">
                    ❤️
                    <span>{{ $shot->likes->count() }}</span>
                </div>

            </div>

        </div>

    </div>

@endforeach

</div>

<!-- MODAL -->
<div
    x-show="open"
    x-transition
    class="fixed inset-0 bg-black/60 z-50 overflow-y-auto"
    style="display:none"
>

    <div class="min-h-screen flex items-start justify-center p-10">

        <div class="bg-white dark:bg-[#0f172a] rounded-3xl max-w-5xl w-full p-10 relative transition-colors duration-300">

            <!-- CLOSE -->
            <button
                @click="open = false"
                class="absolute top-5 right-6 text-4xl text-gray-400 hover:text-black dark:hover:text-white"
            >
                ×
            </button>

            <!-- USER -->
            <div class="flex items-center justify-between mb-8">

                <div>
                    <h2
                        class="text-2xl font-bold text-gray-900 dark:text-white"
                        x-text="selectedShot.user"
                    ></h2>
                </div>

                <!-- LIKES -->
                <div class="flex items-center gap-4">

                    <button
                        @click="
                            fetch('/like/' + selectedShot.id, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                selectedShot.liked = data.liked
                            })
                        "
                        class="w-14 h-14 rounded-full border dark:border-slate-700 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-slate-800 transition"
                    >

                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            :fill="selectedShot.liked ? '#ea4c89' : 'none'"
                            :stroke="selectedShot.liked ? '#ea4c89' : '#0d0c22'"
                            stroke-width="2"
                            class="w-6 h-6 dark:stroke-white">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12.001 4.529c2.349-2.532 6.15-2.532 8.498 0 2.35 2.532 2.35 6.635 0 9.168L12 22 3.5 13.697c-2.35-2.533-2.35-6.636 0-9.168 2.349-2.532 6.15-2.532 8.501 0Z"
                            />

                        </svg>

                    </button>

                    <!-- SAVE -->
                    <button class="w-14 h-14 rounded-full border dark:border-slate-700 bg-white dark:bg-[#111827] flex items-center justify-center hover:bg-gray-100 dark:hover:bg-slate-800 transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="w-6 h-6 text-[#0d0c22] dark:text-white">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17.25 21 12 17.25 6.75 21V5.25A2.25 2.25 0 0 1 9 3h6a2.25 2.25 0 0 1 2.25 2.25V21Z" />

                        </svg>

                    </button>

                </div>

            </div>

            <!-- TITLE -->
            <h1
                class="text-5xl font-bold mb-8 text-gray-900 dark:text-white"
                x-text="selectedShot.title"
            ></h1>

            <!-- IMAGE -->
            <img :src="selectedShot.image" class="w-full rounded-3xl mb-10">

            <!-- DESCRIPTION -->
            <p
                class="text-2xl leading-relaxed text-gray-700 dark:text-slate-300"
                x-text="selectedShot.description"
            ></p>

        </div>

    </div>

</div>

</div>

</x-app-layout>