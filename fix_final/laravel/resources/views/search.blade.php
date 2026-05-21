@extends('layouts.app')
@section('content')

<div
    x-data="searchData()"
    x-init="init()"
    class="min-h-screen bg-[#f8f7f4]"
>

<div class="px-8 lg:px-14 py-10">

    <section class="mb-12">
        <h1 class="text-3xl lg:text-4xl font-bold text-[#0d102d] mb-2">
            Search Results
        </h1>
        <p class="text-gray-500">
            Showing results for "<span class="font-semibold text-[#ea4c89]">{{ $query }}</span>"
        </p>
    </section>

    <form action="{{ route('search') }}" method="GET" class="flex items-center bg-[#f3f3f4] rounded-full p-2 max-w-2xl mb-10">
        <input
            type="text"
            name="q"
            placeholder="What type of design are you interested in?"
            class="flex-1 bg-transparent appearance-none outline-none border-0 focus:ring-0 px-6 py-4 text-lg"
            value="{{ request('q') }}"
        >
        <button type="submit" class="w-10 h-10 bg-[#ea4c89] hover:bg-[#c73e72] text-white rounded-full flex items-center justify-center transition-colors ml-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </button>
    </form>

    <div class="mb-10" x-data="{ sortOpen: false }">
        <div class="flex items-center justify-between flex-wrap gap-4">
            
            <div class="relative">
                <button 
                    @click="sortOpen = !sortOpen"
                    @click.away="sortOpen = false"
                    class="px-4 py-2 rounded-full border border-gray-300 text-sm font-semibold text-gray-700 hover:border-[#ea4c89] hover:text-[#ea4c89] transition whitespace-nowrap flex items-center gap-2"
                >
                    <span x-text="sortOpen ? 'Sort by' : 'Following'"></span>
                    <svg class="w-4 h-4 transition-transform" :class="sortOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <div 
                    x-show="sortOpen"
                    x-transition
                    class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg py-1 z-50"
                >
                    <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4] hover:text-[#ea4c89]">Following</button>
                    <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4] hover:text-[#ea4c89]">Popular</button>
                    <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4] hover:text-[#ea4c89]">New & Noteworthy</button>
                </div>
            </div>

            <div class="flex-1 min-w-0 px-4">
                <div class="flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar">
                    
                    <a href="{{ route('category', ['name' => 'discover']) }}" 
                       class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ !request()->has('category') || request('category') == 'discover' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                        Discover
                    </a>

                    <a href="{{ route('category', ['name' => 'animation']) }}" 
                       class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'animation' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                        Animation
                    </a>

                    <a href="{{ route('category', ['name' => 'branding']) }}" 
                       class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'branding' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                        Branding
                    </a>

                    <a href="{{ route('category', ['name' => 'illustration']) }}" 
                       class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'illustration' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                        Illustration
                    </a>

                    <a href="{{ route('category', ['name' => 'mobile']) }}" 
                       class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'mobile' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                        Mobile
                    </a>

                    <a href="{{ route('category', ['name' => 'print']) }}" 
                       class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'print' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                        Print
                    </a>

                    <a href="{{ route('category', ['name' => 'product-design']) }}" 
                       class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'product-design' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                        Product Design
                    </a>

                    <a href="{{ route('category', ['name' => 'typography']) }}" 
                       class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'typography' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                        Typography
                    </a>

                    <a href="{{ route('category', ['name' => 'web-design']) }}" 
                       class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'web-design' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                        Web Design
                    </a>

                </div>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($shots as $shot)

        <div 
            class="group cursor-pointer"
            @click="openShotModal({{ $shot->id }})"
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
                        <span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </span>
                        <span class="text-[#3d3d4e] text-[13px] font-normal">
                            {{ $shot->likes_count }}
                        </span>
                    </div>
                </div>

                @if($shot->categories && $shot->categories->count())
                <div class="flex flex-wrap gap-2 mt-4 px-1">
                    @foreach($shot->categories as $category)
                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                        {{ $category->name }}
                    </span>
                    @endforeach
                </div>
                @endif

            </div>

        </div>

        @empty

        <div class="col-span-full text-center py-20">
            <div class="text-6xl mb-4">
                <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-[#0d0c22] mb-2">No results found</h3>
            <p class="text-gray-500 mb-6">Try searching with different keywords or browse categories</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#ea4c89] text-white font-semibold rounded-full hover:bg-[#c73e72] transition-colors">
                Back to Home
            </a>
        </div>

        @endforelse

    </div>

</div>

<div 
    x-show="showModal" 
    x-transition.opacity
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
    @click.self="closeModal()"
    style="display: none;"
>
    <div 
        x-show="showModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="w-full max-w-5xl"
    >
        <div x-show="modalLoading" class="bg-white rounded-[32px] p-12 text-center">
            <div class="animate-spin w-8 h-8 border-4 border-gray-200 border-t-[#ea4c89] rounded-full mx-auto mb-4"></div>
            <p class="text-gray-500">Loading shot...</p>
        </div>
        
        <div x-html="modalContent"></div>
    </div>
</div>

</div>

<script>
function searchData() {
    return {
        showModal: false,
        modalLoading: false,
        modalContent: '',

        init() {
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.showModal) {
                    this.closeModal();
                }
            });
        },

        async openShotModal(shotId) {
            this.showModal = true;
            this.modalLoading = true;
            this.modalContent = '';
            document.body.style.overflow = 'hidden';
            
            try {
                const response = await fetch(`/shots/${shotId}/modal`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    }
                });
                
                if (response.ok) {
                    const html = await response.text();
                    this.modalContent = html;
                } else {
                    console.error('Modal error:', response.status);
                    this.modalContent = '<div class="bg-white p-6 rounded-xl text-center text-red-500">Failed to load content</div>';
                }
            } catch (e) {
                console.error('Fetch error:', e);
                this.modalContent = '<div class="bg-white p-6 rounded-xl text-center text-red-500">An error occurred</div>';
            } finally {
                this.modalLoading = false;
            }
        },

        closeModal() {
            this.showModal = false;
            this.modalContent = '';
            document.body.style.overflow = '';
        }
    }
}
</script>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    [x-cloak] { display: none !important; }
</style>

@endsection