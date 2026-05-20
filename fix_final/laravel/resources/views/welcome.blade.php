@extends('layouts.app')
@section('content')

<div
    x-data="welcomeData()"
    x-init="init()"
    class="min-h-screen bg-[#f8f7f4]">

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
                <form action="{{ route('search') }}" method="GET" class="flex items-center bg-[#f3f3f4] rounded-full p-2 max-w-2xl">
                    <input
                        type="text"
                        name="q"
                        placeholder="What type of design are you interested in?"
                        class="flex-1 bg-transparent appearance-none outline-none border-0 focus:ring-0 px-6 py-4 text-lg"
                        value="{{ request('q') }}">
                    <button type="submit" class="w-10 h-10 bg-[#ea4c89] hover:bg-[#c73e72] text-white rounded-full flex items-center justify-center transition-colors ml-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>

            </div>

            <!-- RIGHT -->
            <div>
                <img
                    src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1200&auto=format&fit=crop"
                    class="w-full h-[750px] object-cover rounded-[32px]">
            </div>

        </section>
        <!-- ✅ END HERO -->


        <!-- ✅ CATEGORY FILTER BAR - FIXED: Pink Active + Dropdown + No Filters -->
        <div class="mb-10" x-data="{ sortOpen: false }">
            <div class="flex items-center justify-between flex-wrap gap-4">

                <!-- Left: Dropdown Following/Popular/New -->
                <div class="relative">
                    <button
                        @click="sortOpen = !sortOpen"
                        @click.away="sortOpen = false"
                        class="px-4 py-2 rounded-full border border-gray-300 text-sm font-semibold text-gray-700 hover:border-[#ea4c89] hover:text-[#ea4c89] transition whitespace-nowrap flex items-center gap-2">
                        <span x-text="sortOpen ? 'Sort by' : 'Following'"></span>
                        <svg class="w-4 h-4 transition-transform" :class="sortOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        x-show="sortOpen"
                        x-transition
                        class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg py-1 z-50">
                        <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4] hover:text-[#ea4c89]">Following</button>
                        <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4] hover:text-[#ea4c89]">Popular</button>
                        <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4] hover:text-[#ea4c89]">New & Noteworthy</button>
                    </div>
                </div>

                <!-- Center: Category Pills (Scrollable) -->
                <div class="flex-1 min-w-0 px-4">
                    <div class="flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar">

                        <!-- Discover -->
                        <a href="{{ route('category', ['name' => 'discover']) }}"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap 
                            {{ request()->route('name') == 'discover'
                                ? 'bg-[#ea4c89] text-white'
                                : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                                                        Discover
                        </a>

                        <!-- Animation -->
                        <a href="{{ route('category', ['name' => 'animation']) }}"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request()->route('name') == 'animation' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Animation
                        </a>

                        <!-- Branding -->
                        <a href="{{ route('category', ['name' => 'branding']) }}"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request()->route('name') == 'branding' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Branding
                        </a>

                        <!-- Illustration -->
                        <a href="{{ route('category', ['name' => 'illustration']) }}"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request()->route('name') == 'illustration' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Illustration
                        </a>

                        <!-- Mobile -->
                        <a href="{{ route('category', ['name' => 'mobile']) }}"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request()->route('name') == 'mobile' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Mobile
                        </a>

                        <!-- Print -->
                        <a href="{{ route('category', ['name' => 'print']) }}"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request()->route('name') == 'print' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Print
                        </a>

                        <!-- Product Design -->
                        <a href="{{ route('category', ['name' => 'product-design']) }}"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request()->route('name') == 'product-design' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Product Design
                        </a>

                        <!-- Typography -->
                        <a href="{{ route('category', ['name' => 'typography']) }}"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request()->route('name') == 'typograwphy' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Typography
                        </a>

                        <!-- Web Design -->
                        <a href="{{ route('category', ['name' => 'web-design']) }}"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request()->route('name') == 'web-design' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Web Design
                        </a>

                    </div>
                </div>

                <!-- ✅ Right: Filters Button DIHAPUS -->

            </div>
        </div>
        <!-- ✅ END CATEGORY FILTER BAR -->


        <!-- SHOTS GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    @foreach($shots as $shot)

    <!-- CARD -->
    <a
        href="{{ route('shots.show', $shot->id) }}"
        class="block group">

        <div class="bg-white rounded-[26px] p-3 transition duration-300 hover:-translate-y-1">

            <div class="overflow-hidden rounded-[22px] bg-gray-100">
                <img
                    src="{{ $shot->image_url }}"
                    alt="{{ $shot->title }}"
                    onerror="this.src='https://placehold.co/600x400?text=No+Image'"
                    class="w-full h-[260px] object-cover transition duration-500 group-hover:scale-[1.02]">
            </div>

            <div class="flex items-center justify-between mt-4 px-1">

                <div class="flex items-center gap-3 min-w-0">
                    <img
                        src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username ?? 'U') }}"
                        alt="{{ $shot->user->username ?? 'User' }}"
                        class="w-8 h-8 rounded-full object-cover shrink-0">

                    <div class="min-w-0">
                        <h3 class="text-[14px] font-semibold text-[#0d0c22] truncate leading-tight">
                            {{ $shot->user->username ?? 'Unknown' }}
                        </h3>
                    </div>
                </div>

                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-50 shrink-0">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        class="w-5 h-5 text-[#ea4c89]">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>

                    <span class="text-[#3d3d4e] text-[13px] font-medium">
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

    </a>

    @endforeach

</div>
   

