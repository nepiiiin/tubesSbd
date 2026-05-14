<x-app-layout>
    
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 p-6">

    @foreach($shots as $shot)

        <div class="group">

            {{-- IMAGE --}}
            <div class="overflow-hidden rounded-2xl bg-gray-100">

                <img
                    src="{{ $shot->image_url }}"
                    alt="{{ $shot->title }}"
                    onerror="this.src='https://placehold.co/600x400?text=No+Image'"
                    class="w-full h-[350px] object-cover hover:scale-105 transition duration-300"
                >

            </div>

            {{-- INFO --}}
            <div class="flex items-center justify-between mt-3">

                <div class="flex items-center gap-3">

                    {{-- AVATAR --}}
                    <img
                        src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username) }}"
                        class="w-8 h-8 rounded-full object-cover"
                    >

                    <div>

                        <h3 class="font-semibold text-sm">
                            {{ $shot->title }}
                        </h3>

                        <p class="text-xs text-gray-500">
                            {{ $shot->user->username ?? 'Unknown' }}
                        </p>

                    </div>

                </div>

                {{-- LIKES --}}
                <div class="flex items-center gap-1 text-gray-500 text-sm">
                    ❤️
                    <span>{{ $shot->likes->count() }}</span>
                </div>

            </div>

        </div>

    @endforeach

</div>

<div class="p-6">
    {{ $shots->links() }}
</div>
<div class="p-6">
    {{ $shots->links() }}
</div>
   
</x-app-layout>
