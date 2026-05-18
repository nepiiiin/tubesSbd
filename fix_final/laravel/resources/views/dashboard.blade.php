<x-app-layout>

<div
    x-data="{ open:false, selectedShot:null }"
    class="min-h-screen bg-[#f8f7f4]"
>

    <div class="max-w-[1600px] mx-auto px-6 md:px-16 lg:px-24 py-10">

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

                <div class="bg-white rounded-[26px] p-3 transition duration-300 hover:-translate-y-1">

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