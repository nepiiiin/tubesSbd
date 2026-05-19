<!-- resources/views/partials/shot_modal_content.blade.php -->
<div class="bg-white rounded-[32px] shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
    
    <!-- HEADER -->
    <div class="flex items-center justify-between px-8 py-6 border-b border-gray-100 sticky top-0 bg-white z-10">
        <!-- LEFT: Designer Info -->
        <div class="flex items-center gap-4">
            <!-- Avatar -->
            <div class="relative">
                <img src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username ?? 'U') }}"
                     alt="{{ $shot->user->username ?? 'User' }}"
                     class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                @if($shot->user->available_for_work ?? false)
                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                @endif
            </div>

            <!-- Name & Status -->
            <div>
                <h3 class="font-bold text-gray-900 text-base leading-tight">
                    {{ $shot->user->username ?? 'Unknown User' }}
                </h3>
                @if($shot->user->available_for_work ?? false)
                <p class="text-green-600 text-sm font-medium">Available for work</p>
                @endif
            </div>

            <!-- Follow Button -->
            @auth
                @if(auth()->id() !== $shot->user_id)
                <button class="ml-3 text-gray-500 hover:text-gray-900 font-medium text-sm transition">
                    Follow
                </button>
                @endif
            @endauth
        </div>

        <!-- RIGHT: Action Buttons -->
        <div class="flex items-center gap-3">
            <!-- Like Button -->
            <button class="group w-11 h-11 rounded-full border border-gray-200 hover:border-pink-300 hover:bg-pink-50 flex items-center justify-center transition-all">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-pink-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>

            <!-- Save Button -->
            <button class="group w-11 h-11 rounded-full border border-gray-200 hover:border-gray-400 hover:bg-gray-50 flex items-center justify-center transition-all">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
            </button>

            <!-- Get in Touch Button -->
            @auth
            <button class="bg-[#0d0c22] text-white px-6 py-2.5 rounded-full font-semibold hover:bg-gray-800 transition shadow-lg">
                Get in touch
            </button>
            @else
            <a href="{{ route('login') }}" class="bg-[#0d0c22] text-white px-6 py-2.5 rounded-full font-semibold hover:bg-gray-800 transition shadow-lg">
                Get in touch
            </a>
            @endauth

            <!-- Close Button -->
            <button @click="closeModal()" class="ml-2 w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center transition">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="p-8">
        <!-- Title -->
        <h2 class="text-4xl font-bold text-gray-900 mb-6">
            {{ $shot->title }}
        </h2>

        <!-- Main Image -->
        <div class="relative bg-[#c8d8b8] rounded-[24px] overflow-hidden mb-8">
            <img src="{{ $shot->image_url }}" 
                 alt="{{ $shot->title }}" 
                 class="w-full h-auto object-cover">
        </div>

        <!-- Description -->
        @if($shot->description)
        <p class="text-gray-600 text-lg mb-8 max-w-3xl whitespace-pre-line">
            {{ $shot->description }}
        </p>
        @endif

        <!-- Categories -->
        @if($shot->categories && $shot->categories->count())
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach($shot->categories as $category)
            <span class="px-4 py-1.5 bg-gray-100 rounded-full text-sm text-gray-600 font-medium">
                {{ $category->name }}
            </span>
            @endforeach
        </div>
        @endif

        <!-- Additional Info Row -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-100">
            <!-- Left: Stats -->
            <div class="flex items-center gap-6">
                <!-- Views -->
                <div class="flex items-center gap-2 text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span class="font-medium">{{ $shot->views_count ?? 0 }}</span>
                </div>

                <!-- Likes -->
                <div class="flex items-center gap-2 text-gray-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="font-medium">{{ $shot->likes_count ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FLOATING ACTION BUTTONS (Right Side) -->
<div class="fixed right-8 top-1/2 -translate-y-1/2 flex flex-col gap-3 z-[110]">
    <!-- Comments -->
    <button class="group relative w-12 h-12 bg-white rounded-full shadow-lg border border-gray-200 hover:border-gray-400 flex items-center justify-center transition-all">
        <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
    </button>

    <!-- Share -->
    <button class="group w-12 h-12 bg-white rounded-full shadow-lg border border-gray-200 hover:border-gray-400 flex items-center justify-center transition-all">
        <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
        </svg>
    </button>

    <!-- Info -->
    <button class="group w-12 h-12 bg-white rounded-full shadow-lg border border-gray-200 hover:border-gray-400 flex items-center justify-center transition-all">
        <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </button>
</div>