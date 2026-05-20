<x-app-layout>
    <div class="py-12 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col items-center text-center mb-16">
                <div class="w-24 h-24 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-3xl font-bold text-gray-500 dark:text-gray-400 mb-4 overflow-hidden border-2 border-gray-100 dark:border-gray-800">
                    @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" class="w-full h-full object-cover">
                    @else
                    {{ strtoupper(substr($user->full_name, 0, 2)) }}
                    @endif
                </div>

                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ $user->full_name }}</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-lg">
                    {{ $user->location ?? 'Indonesia' }} • @ {{ $user->username }}
                </p>

                @if($user->bio)
                <p class="mt-4 text-gray-600 dark:text-gray-300 max-w-lg mx-auto">{{ $user->bio }}</p>
                @endif

                <div class="mt-6 flex space-x-3">
                    @if(Auth::id() === $user->id)
                    <a href="{{ route('profile.edit') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-full font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition">Edit Profile</a>
                    @else
                    <button class="px-6 py-2 bg-black dark:bg-white text-white dark:text-black rounded-full font-semibold hover:bg-gray-800 dark:hover:bg-gray-200 transition">Follow</button>
                    <button class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-full font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition">Hire Me</button>
                    @endif
                </div>
            </div>

            <div class="border-b border-gray-200 dark:border-gray-700 mb-8">
                <nav class="flex space-x-8">
                    <a href="{{ route('user.profile', ['username' => $user->username]) }}"
                        class="pb-4 text-sm {{ $tab === 'work' ? 'border-b-2 border-black dark:border-white font-bold text-gray-900 dark:text-white' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white' }}">
                        Work
                    </a>
                    <a href="{{ route('user.profile', ['username' => $user->username, 'tab' => 'collections']) }}"
                        class="pb-4 text-sm {{ $tab === 'collections' ? 'border-b-2 border-black dark:border-white font-bold text-gray-900 dark:text-white' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white' }}">
                        Collections
                    </a>
                    <a href="{{ route('user.profile', ['username' => $user->username, 'tab' => 'liked']) }}"
                        class="pb-4 text-sm {{ $tab === 'liked' ? 'border-b-2 border-black dark:border-white font-bold text-gray-900 dark:text-white' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white' }}">
                        Liked Shots
                    </a>
                    <a href="{{ route('user.profile', ['username' => $user->username, 'tab' => 'about']) }}"
                        class="pb-4 text-sm {{ $tab === 'about' ? 'border-b-2 border-black dark:border-white font-bold text-gray-900 dark:text-white' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white' }}">
                        About
                    </a>
                </nav>
            </div>

            <div>
                @if($tab === 'work')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($shots as $shot)
                    <a href="{{ route('shots.show', $shot->id) }}" class="group block">
                        <div class="rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 aspect-[4/3] mb-3 relative">
                            <img src="{{ asset('storage/' . $shot->image_url) }}"
                                class="w-full h-full object-cover group-hover:opacity-90 transition">
                        </div>

                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm truncate">
                                {{ $shot->title }}
                            </h3>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-3 text-center py-20 text-gray-400 dark:text-gray-500 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl">
                        <a
    href="{{ route('posts.create') }}"
    class="text-lg font-medium text-gray-900 dark:text-white hover:text-pink-500 transition"
>
    Upload your first shot
</a>
                        <p class="text-sm mt-1">Show off your best work. Get feedback, likes and be a part of a community.</p>
                    </div>
                    @endforelse
                </div>

               <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    @forelse($collections as $collection)

    <a
        href="{{ route('collections.show', $collection->id) }}"
        class="group block"
    >

        <div class="rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:shadow-lg transition">

            <div class="grid grid-cols-2 gap-1 h-52 bg-gray-100">

                @forelse($collection->shots->take(4) as $shot)

                <img
                    src="{{ asset('storage/' . $shot->image_url) }}"
                    class="w-full h-full object-cover"
                >

                @empty

                <div class="col-span-2 flex items-center justify-center text-gray-400">

                    Empty Collection

                </div>

                @endforelse

            </div>

            <div class="p-4">

                <h3 class="font-bold text-gray-900 dark:text-white">

                    {{ $collection->name }}

                </h3>

                <p class="text-sm text-gray-500 mt-1">

                    {{ $collection->shots->count() }} shots

                </p>

            </div>

        </div>

    </a>

    @empty

    <div class="col-span-3 text-center py-20 text-gray-400">

        Belum ada collection

    </div>

    @endforelse

</div>

              @elseif($tab === 'liked')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    @forelse($shots as $shot)

    <div class="relative group cursor-pointer">

        <div class="bg-white dark:bg-gray-900 rounded-[26px] p-3 transition duration-300 hover:-translate-y-1 hover:shadow-xl">

            <a href="{{ route('shots.show', $shot->id) }}">

                <div class="overflow-hidden rounded-[22px] bg-gray-100 relative">

                    <img
                        src="{{ $shot->image_url }}"
                        alt="{{ $shot->title }}"
                        onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=No+Image'"
                        class="w-full h-[260px] object-cover transition duration-500 group-hover:scale-[1.03] pointer-events-none"
                    >

                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors rounded-[22px]"></div>

                </div>

            </a>

            <!-- USER + LIKES -->
            <div class="flex items-center justify-between mt-4 px-1">

                <div class="flex items-center gap-3 min-w-0">

                    <img
                        src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username ?? 'U') }}"
                        class="w-8 h-8 rounded-full object-cover shrink-0 border border-gray-100"
                    >

                    <div class="min-w-0">

                        <h3 class="text-[14px] font-semibold text-[#0d0c22] dark:text-white truncate">

                            {{ $shot->user->username }}

                        </h3>

                    </div>

                </div>

                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-pink-50 text-pink-500">

                    ❤️

                    <span class="text-[13px] font-medium">

                        {{ $shot->likes_count }}

                    </span>

                </div>

            </div>

        </div>

    </div>

    @empty

    <div class="col-span-full text-center py-20">

        <div class="text-6xl mb-4">💔</div>

        <h3 class="text-xl font-semibold text-[#0d0c22] dark:text-white mb-2">

            No liked shots yet

        </h3>

        <p class="text-gray-500">

            Like some shots and they'll appear here.

        </p>

    </div>

    @endforelse

</div>

                @elseif($tab === 'about')
                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-2xl text-gray-700 dark:text-gray-300">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Tentang {{ $user->full_name }}</h2>
                    <p>{{ $user->bio ?? 'User belum menulis bio lengkap.' }}</p>
                    <div class="mt-6 text-sm text-gray-500">
                        <p>Email Terhubung: {{ $user->email }}</p>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>