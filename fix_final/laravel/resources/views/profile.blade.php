<x-app-layout>
    <div class="py-12 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Profile Header -->
            <div class="flex flex-col items-center text-center mb-16">
                <!-- Avatar -->
                <div class="w-24 h-24 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-3xl font-bold text-gray-500 dark:text-gray-400 mb-4 overflow-hidden border-2 border-gray-100 dark:border-gray-800">
                    @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->full_name, 0, 2)) }}
                    @endif
                </div>
                
                <!-- Info User -->
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ $user->full_name }}</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-lg">
                    {{ $user->location ?? 'Indonesia' }} • @ {{ $user->username }}
                </p>

                <!-- Deskripsi/Bio -->
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

            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 dark:border-gray-700 mb-8">
                <nav class="flex space-x-8">
                    <a href="#" class="border-b-2 border-black dark:border-white pb-4 text-sm font-bold text-gray-900 dark:text-white">Work</a>
                    <a href="#" class="pb-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition">Collections</a>
                    <a href="#" class="pb-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition">Liked Shots</a>
                    <a href="#" class="pb-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition">About</a>
                </nav>
            </div>

            <!-- Shots Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($shots as $shot)
                    <div class="group cursor-pointer">
                        <div class="rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 aspect-[4/3] mb-3 relative">
                            <img src="{{ $shot->image_url }}" class="w-full h-full object-cover group-hover:opacity-90 transition">
                        </div>
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm truncate">{{ $shot->title }}</h3>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20 text-gray-400 dark:text-gray-500 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl">
                        <p class="text-lg font-medium text-gray-900 dark:text-white">Upload your first shot</p>
                        <p class="text-sm mt-1">Show off your best work. Get feedback, likes and be a part of a community.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>