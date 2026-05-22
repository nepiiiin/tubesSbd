<div class="bg-white rounded-[32px] shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
    
    <div class="flex items-center justify-between px-8 py-6 border-b border-gray-100 sticky top-0 bg-white z-10">
        <div class="flex items-center gap-4">
            <div class="relative">
                <img src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=User' }}"
                    alt="{{ $shot->user->username ?? 'User' }}"
                     class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
            </div>

            <div>
                <h3 class="font-bold text-gray-900 text-base leading-tight">
                    {{ $shot->user->username ?? 'Unknown User' }}
                </h3>
            </div>

            @auth
                @if($shot->user && auth()->id() !== $shot->user_id)
                <button
                onclick="followUser({{ $shot->user_id }}, this)"
                class="ml-3 text-gray-500 hover:text-gray-900 font-medium text-sm transition"
            >
                {{ $shot->isFollowedBy(auth()->user()) ? 'Following' : 'Follow' }}
            </button>
                @endif
            @endauth
        </div>

        <div class="flex items-center gap-3">
            <button
                type="button"
                onclick="likeShotModal({{ $shot->id }}, this)"
                class="modal-like-button group w-11 h-11 rounded-full border border-gray-200 hover:border-pink-300 hover:bg-pink-50 flex items-center justify-center transition-all {{ auth()->check() && $shot->isLikedBy(auth()->user()) ? 'text-[#ea4c89]' : 'text-gray-600' }}"
            >
                <svg 
                    class="w-5 h-5 transition modal-like-svg {{ auth()->check() && $shot->isLikedBy(auth()->user()) ? 'text-[#ea4c89]' : 'text-gray-600' }}"
                    fill="{{ auth()->check() && $shot->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}"
                    stroke="currentColor"
        viewBox="0 0 24 24"
                >
                     
                    <path 
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                    </path>
                </svg>
            </button>

            <button
                onclick="saveShotModal({{ $shot->id }}, this)"
                class="group w-11 h-11 rounded-full border border-gray-200 hover:border-gray-400 hover:bg-gray-50 flex items-center justify-center transition-all"
            >
                <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900 transition"
                    fill="{{ auth()->check() && $shot->isSavedBy(auth()->user()) ? 'currentColor' : 'none' }}"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z">
                    </path>
                </svg>
            </button>

            @auth
            <button 
                type="button"
                onclick="openGetInTouchModal({{ $shot->id }})"
                class="bg-[#0d0c22] text-white px-6 py-2.5 rounded-full font-semibold hover:bg-gray-800 transition shadow-lg"
            >
                Get in touch
            </button>
            @else
            <a href="{{ route('login') }}" class="bg-[#0d0c22] text-white px-6 py-2.5 rounded-full font-semibold hover:bg-gray-800 transition shadow-lg">
                Get in touch
            </a>
            @endauth

            <button @click="closeModal()" class="ml-2 w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center transition">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="p-8">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">
            {{ $shot->title }}
        </h2>

        <div class="relative bg-[#c8d8b8] rounded-[24px] overflow-hidden mb-8">
            <img src="{{ \Illuminate\Support\Str::startsWith($shot->image_url, 'http') ? $shot->image_url : asset('storage/' . $shot->image_url) }}"
                 alt="{{ $shot->title }}" 
                 class="w-full h-auto object-cover">
        </div>

        @if($shot->description)
        <p class="text-gray-600 text-lg mb-8 max-w-3xl whitespace-pre-line">
            {{ $shot->description }}
        </p>
        @endif

        @if($shot->categories && $shot->categories->count())
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach($shot->categories as $category)
            <span class="px-4 py-1.5 bg-gray-100 rounded-full text-sm text-gray-600 font-medium">
                {{ $category->name }}
            </span>
            @endforeach
        </div>
        @endif

                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 text-gray-500">
                    <svg 
                        id="modal-bottom-like-icon-{{ $shot->id }}"
                        class="w-5 h-5 modal-like-icon {{ auth()->check() && $shot->isLikedBy(auth()->user()) ? 'text-[#ea4c89]' : 'text-gray-500' }}"
                        fill="{{ auth()->check() && $shot->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}"
                        viewBox="0 0 24 24"
                    >
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>

                    <span 
                        id="modal-like-count-{{ $shot->id }}"
                        data-shot-id="{{ $shot->id }}"
                        class="like-count font-medium"
                    >
                        {{ $shot->likes_count ?? 0 }}
                    </span>
                </div>
            </div>
        </div>

        <div id="comments-section-{{ $shot->id }}" class="mt-8 pt-8 border-t border-gray-100 bg-white">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">
                Comments
            </h3>

            <div id="comments-list-{{ $shot->id }}" class="space-y-5">
                @forelse($shot->comments as $comment)

                <div class="flex gap-3">
                    <img
                        src="{{ $comment->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->username ?? 'U') }}"
                        class="w-10 h-10 rounded-full object-cover"
                    >

                    <div>
                        <div class="flex items-center gap-2">
                            <h4 class="font-semibold text-gray-900">
                                {{ $comment->user->username }}
                            </h4>

                            <span class="text-xs text-gray-400">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <p class="text-gray-600 text-sm mt-1">
                            {{ $comment->body }}
                        </p>
                    </div>
                </div>

                @empty

                <div id="empty-comments-{{ $shot->id }}" class="text-gray-400 text-sm">
                    Belum ada komentar. Jadilah yang pertama komentar.
                </div>

                @endforelse
            </div>

            @auth
            <form 
                class="mt-6 flex gap-3"
                onsubmit="commentShotModal(event, {{ $shot->id }}, this)"
            >
                <img
                    src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->username ?? 'U') }}"
                    class="w-10 h-10 rounded-full object-cover"
                >

                <div class="flex-1">
                    <textarea
                        name="body"
                        rows="3"
                        placeholder="Tulis komentar..."
                        class="w-full rounded-2xl border border-gray-200 focus:border-gray-400 focus:ring-0 text-sm resize-none text-gray-900 bg-white"
                        required
                    ></textarea>

                    <div class="flex justify-end mt-2">
                        <button
                            type="submit"
                            class="px-5 py-2 rounded-full bg-[#0d0c22] text-white text-sm font-semibold hover:bg-gray-800 transition"
                        >
                            Comment
                        </button>
                    </div>
                </div>
            </form>
            @else
            <div class="mt-6 text-sm text-gray-500">
                <a href="{{ route('login') }}" class="font-semibold text-[#ea4c89]">
                    Login
                </a>
                untuk menulis komentar.
            </div>
            @endauth
        </div>

    </div>
</div>

<div class="fixed right-8 top-1/2 -translate-y-1/2 flex flex-col gap-3 z-[110]">
    <button 
    type="button"
    onclick="document.getElementById('comments-section-{{ $shot->id }}')?.scrollIntoView({ behavior: 'smooth', block: 'start' })"
    class="group relative w-12 h-12 bg-white rounded-full shadow-lg border border-gray-200 hover:border-gray-400 flex items-center justify-center transition-all"
>
        <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
    </button>

    <button class="group w-12 h-12 bg-white rounded-full shadow-lg border border-gray-200 hover:border-gray-400 flex items-center justify-center transition-all">
        <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
        </svg>
    </button>

    <button class="group w-12 h-12 bg-white rounded-full shadow-lg border border-gray-200 hover:border-gray-400 flex items-center justify-center transition-all">
        <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </button>
</div>

@auth
<div 
    id="get-in-touch-modal-{{ $shot->id }}"
    class="fixed inset-0 z-[300] hidden items-center justify-center bg-black/50 backdrop-blur-sm px-4"
>
    <div class="bg-white w-full max-w-md rounded-[28px] shadow-2xl p-7 relative">

        <button
            type="button"
            onclick="closeGetInTouchModal({{ $shot->id }})"
            class="absolute top-5 right-5 text-gray-400 hover:text-gray-700 transition text-xl"
        >
            ×
        </button>

        <div class="flex items-center gap-4 mb-6">
            <img
                src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username ?? 'U') }}"
                class="w-14 h-14 rounded-full object-cover border border-gray-200"
            >

            <div>
                <h3 class="text-xl font-bold text-[#0d0c22]">
                    Connect with {{ $shot->user->username ?? 'Designer' }}
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    Responds within a few days
                </p>
            </div>
        </div>

<div class="flex items-center gap-3 mb-6">
    <button
        type="button"
        class="px-4 py-2 rounded-full bg-gray-100 text-[#0d0c22] text-sm font-semibold"
    >
        Message
    </button>
</div>
        
    <div id="message-content-{{ $shot->id }}">
        <form 
            onsubmit="sendGetInTouchMessage(event, {{ $shot->id }}, this)"
            data-designer-email="{{ $shot->user->email }}"
            data-designer-username="{{ $shot->user->username }}"
            data-shot-title="{{ $shot->title }}"
        >

            <div class="mb-5">
                <label class="flex items-center justify-between text-sm font-semibold text-[#0d0c22] mb-2">
                    <span>Project Details <span class="text-pink-500">*</span></span>
                    <span class="text-xs text-gray-400">Minimum 50 characters</span>
                </label>

                <textarea
                    name="message"
                    rows="6"
                    minlength="50"
                    required
                    placeholder="Include any project details, requirements, or goals..."
                    class="w-full rounded-2xl border border-gray-200 focus:border-pink-400 focus:ring-pink-400 text-sm resize-none text-gray-900"
                ></textarea>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-[#0d0c22] mb-2">
                    Target Date <span class="text-pink-500">*</span>
                </label>

                <select
                    name="target_date"
                    required
                    class="w-full rounded-2xl border border-gray-200 focus:border-pink-400 focus:ring-pink-400 text-sm text-gray-700"
                >
                    <option value="">Please select...</option>
                    <option value="ASAP">As soon as possible</option>
                    <option value="1-2 weeks">1–2 weeks</option>
                    <option value="1 month">Within 1 month</option>
                    <option value="flexible">Flexible</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-[#0d0c22] mb-2">
                    Project Budget <span class="text-pink-500">*</span>
                </label>

                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="budget"
                        required
                        min="0"
                        placeholder="Enter amount"
                        class="w-full rounded-2xl border border-gray-200 focus:border-pink-400 focus:ring-pink-400 text-sm pl-12 text-gray-900"
                    >
                </div>

                <label class="flex items-center gap-2 mt-3 text-xs text-gray-600">
                    <input
                        type="checkbox"
                        name="recommend_budget"
                        class="rounded border-gray-300 text-pink-500 focus:ring-pink-500"
                    >
                    Let designer recommend a budget
                </label>
            </div>

            <button
                type="submit"
                class="w-full h-12 rounded-full bg-[#ea4c89] hover:bg-[#c73e72] text-white font-bold transition"
            >
                Send Message
            </button>

        </form>
    </div>
</div>

    
    </div>
</div>
@endauth