<x-app-layout>

<div
    x-data="{ open:false, selectedShot:null }"
    class="min-h-screen bg-[#f8f7f4]"
>

<div class="px-8 lg:px-14 py-10">

    <!-- HERO -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">

        <!-- LEFT -->
        <div>

            <h1 class="text-[72px] lg:text-[96px] leading-[0.9] font-black text-[#0d102d] tracking-[-4px] mb-8">
                Discover the World's Top Designers
            </h1>

            <p class="text-gray-500 text-xl lg:text-2xl leading-relaxed mb-10 max-w-2xl">
                Explore work from the most talented and accomplished
                designers ready to take on your next project.
            </p>

            <!-- SEARCH -->
            <div class="flex items-center bg-[#f3f3f4] rounded-full p-2 max-w-2xl">

                <input
                    type="text"
                    placeholder="What type of design are you interested in?"
                    class="flex-1 bg-transparent appearance-none outline-none border-0 focus:ring-0 px-6 py-4 text-lg"
                >

                <button class="w-16 h-16 rounded-full bg-pink-500 text-white text-2xl hover:scale-105 transition">
                    🔍︎
                </button>

            </div>

        </div>

        <!-- RIGHT -->
        <div>

            <img
                src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1200&auto=format&fit=crop"
                class="w-full h-[750px] object-cover rounded-[32px]"
            >

        </div>

    </section>



    <!-- SHOTS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($shots as $shot)

        <div
            @click="
                open = true;
                selectedShot = {
                    id: {{ $shot->id }},
                    liked: false,
                    title: '{{ addslashes($shot->title) }}',
                    image: '{{ $shot->image_url }}',
                    user: '{{ addslashes($shot->user->username ?? 'Unknown') }}',
                    description: '{{ addslashes($shot->description) }}'
                }
            "
            class="group cursor-pointer"
        >

            <div
                class="bg-white rounded-[26px] p-3 transition duration-300 hover:-translate-y-1"
            >

                <div class="overflow-hidden rounded-[22px] bg-gray-100">

                    <img
                        src="{{ $shot->image_url }}"
                        alt="{{ $shot->title }}"
                        onerror="this.src='https://placehold.co/600x400?text=No+Image'"
                        class="w-full h-[260px] object-cover transition duration-500 group-hover:scale-[1.02]"
                    >

                </div>

                <div class="flex items-center justify-between mt-4 px-1">

                    <div class="flex items-center gap-3 min-w-0">

                        <img
                            src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username ?? 'U') }}"
                            alt="{{ $shot->user->username ?? 'User' }}"
                            class="w-8 h-8 rounded-full object-cover shrink-0"
                        >

                        <div class="min-w-0">

                            <h3 class="text-[14px] font-semibold text-[#0d0c22] truncate leading-tight">
                                {{ $shot->user->username ?? 'Unknown' }}
                            </h3>

                        </div>

                    </div>

                    <div class="flex items-center gap-1 text-gray-500 text-sm font-medium shrink-0">

                        <span>❤️</span>

                        <span class="text-[#3d3d4e] text-[13px] font-normal">
                            {{ $shot->likes_count }}
                        </span>

                    </div>

                </div>

                @if($shot->categories && $shot->categories->count())

                <div class="flex flex-wrap gap-2 mt-4 px-1">

                    @foreach($shot->categories as $category)

                    <span
                        class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600"
                    >
                        {{ $category->name }}
                    </span>

                    @endforeach

                </div>

                @endif

            </div>

        </div>

        @endforeach

    </div>

</div>

</div>

</x-app-layout>