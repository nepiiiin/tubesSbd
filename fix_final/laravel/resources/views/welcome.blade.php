<x-app-layout>

<div class="px-8 lg:px-14 py-10 bg-white">

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
                    class="flex-1 bg-transparent outline-none px-6 py-4 text-lg"
                >

                <button class="w-16 h-16 rounded-full bg-pink-500 text-white text-2xl hover:scale-105 transition">
                    🔍
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
    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-10">

        @foreach($shots as $shot)

            <div class="group cursor-pointer">

                <!-- IMAGE -->
                <div class="relative overflow-hidden rounded-[24px] bg-gray-100">

                    <img
                        src="{{ $shot->image_url }}"
                        alt="{{ $shot->title }}"
                        onerror="this.src='https://placehold.co/600x400?text=No+Image'"
                        class="w-full h-[360px] object-cover group-hover:scale-105 transition duration-500"
                    >

                    <!-- OVERLAY -->
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition duration-300"></div>

                </div>


                <!-- INFO -->
                <div class="flex items-start justify-between mt-4">

                    <div class="flex items-center gap-3">

                        <!-- AVATAR -->
                        <img
                            src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username) }}"
                            class="w-9 h-9 rounded-full object-cover"
                        >

                        <div>

                            <h3 class="font-semibold text-[15px] text-[#0d102d]">
                                {{ $shot->title }}
                            </h3>

                            <div class="flex flex-wrap gap-2 mt-1">

                                <span class="text-xs text-gray-500">
                                    {{ $shot->user->username ?? 'Unknown' }}
                                </span>

                                @foreach($shot->categories as $category)

                                    <span class="text-[10px] px-2 py-1 bg-[#ea4c89] rounded-full text-white">
                                        {{ $category->name }}
                                    </span>

                                @endforeach

                            </div>

                        </div>

                    </div>

                    <!-- LIKES -->
                    <div class="flex items-center gap-1 text-gray-500 text-sm mt-1">

                        <span>❤️</span>

                        <span>
                            {{ $shot->likes->count() }}
                        </span>

                    </div>

                </div>

            </div>

        @endforeach

    </section>

</div>

</x-app-layout>