<nav 
    x-data="{ 
        mobileMenu: false, 
        showSearch: false,
        searchOpen: false,
        exploreOpen: false,
        activeCategory: 'discover'
    }"
    @scroll.window="showSearch = (window.pageYOffset > 400)"
    class="fixed top-0 left-0 w-full z-50 bg-white border-b border-gray-200 py-3 px-4 lg:px-6"
>
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">

        <div class="flex-none">
            <a
                href="{{ route('home') }}"
                class="text-2xl font-black tracking-tighter text-[#0d0c22] hover:text-[#ea4c89] transition-colors">
                dribbble
            </a>
        </div>

        <div class="flex-1 flex items-center justify-center min-w-0"
             :class="showSearch ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-4 pointer-events-none'"
        >
            
            <form 
                action="{{ route('search') }}" 
                method="GET" 
                class="hidden md:flex items-center bg-[#f3f3f4] rounded-full px-2 py-1.5 focus-within:ring-2 focus-within:ring-[#ea4c89]/30 transition-all max-w-xl w-full"
            >
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="What are you looking for?"
                    class="flex-1 bg-transparent border-none outline-none px-4 py-2 text-sm text-[#0d0c22] placeholder-gray-500 min-w-0"
                >

                <button type="submit" class="ml-1 w-10 h-10 flex items-center justify-center bg-[#ea4c89] hover:bg-[#c73e72] text-white rounded-full transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>

            <button 
                @click="searchOpen = !searchOpen"
                class="md:hidden p-2 text-gray-500 hover:text-[#ea4c89] transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>

            <div 
                x-show="searchOpen" 
                x-transition
                class="absolute top-full left-0 right-0 bg-white border-b border-gray-200 p-4 md:hidden z-40"
            >
                <form action="{{ route('search') }}" method="GET" class="flex items-center bg-[#f3f3f4] rounded-full px-4 py-2">
                    <input 
                        type="text" 
                        name="q" 
                        placeholder="Search shots, designers..." 
                        class="flex-1 bg-transparent border-none outline-none text-sm text-[#0d0c22]"
                    >
                    <button type="submit" class="text-[#ea4c89] ml-2 hover:text-[#c73e72] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>

        <div class="flex-none flex items-center gap-2 lg:gap-4">

            <div class="hidden lg:flex items-center gap-5">
                
                <div class="relative" @click.away="exploreOpen = false">
                    <button 
                        @click="exploreOpen = !exploreOpen"
                        class="flex items-center gap-1 text-sm font-semibold text-[#0d0c22] hover:text-[#ea4c89] transition-colors focus:outline-none"
                    >
                        Explore
                        <svg class="w-4 h-4 transition-transform" :class="exploreOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div 
                        x-show="exploreOpen"
                        x-transition
                        class="absolute right-0 top-full mt-2 w-64 bg-white border border-gray-200 rounded-2xl shadow-xl py-3 z-50"
                    >
                        <div class="px-3 pb-3 border-b border-gray-100">
                            <a href="{{ url('/dashboard/following') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#f8f7f4] transition-colors group">
                                <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ea4c89]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-800">Following</span>
                            </a>
                            <a href="{{ url('/dashboard/popular') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#f8f7f4] transition-colors group">
                                <svg class="w-5 h-5 text-gray-600 group-hover:text-[#d83372]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-800">Popular</span>
                            </a>
                            <a href="{{ url('/dashboard/new') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#f8f7f4] transition-colors group">
                                <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ea4c89]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-800">New and Noteworthy</span>
                            </a>
                        </div>

                       <div class="flex-1 min-w-0 px-4">
    <div class="flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar">
        
<a
    href="{{ route('category', ['name' => 'discover']) }}"
    class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap capitalize bg-[#ea4c89] text-white"
>
    Discover
</a>

        @foreach($categories as $category)
            @if(strtolower($category->name) !== 'discover') {{-- Agar data discover tidak double kalau ada di DB --}}
<a
    href="{{ route('category', ['name' => $category->name]) }}"
    class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap capitalize bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white"
>
    {{ str_replace('-', ' ', $category->name) }}
</a>
            @endif
        @endforeach

    </div>
</div>
                    </div>
                </div>

                <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-[#0d0c22] hover:text-[#ea4c89] transition-colors">
                    Get Hired
                </a>

                <a href="{{ route('talent.index') }}"
                    class="text-sm font-semibold text-[#0d0c22] hover:text-[#ea4c89] transition-colors">
                        Post Job
                </a>

            @if(in_array(Auth::user()->role ?? '', ['employer', 'admin']))
    <a href="{{ route('jobs.create') }}" class="text-sm font-semibold text-[#0d0c22] hover:text-[#ea4c89] transition-colors">
        Hire
    </a>
@endif
                
                @if(in_array(Auth::user()->role ?? '', ['employer', 'admin']))
                    <a href="{{ route('jobs.create') }}" class="text-sm font-semibold text-[#0d0c22] hover:text-[#ea4c89] transition-colors">Hire</a>
                @endif
            </div>

            @guest
                <a href="{{ route('login') }}" class="hidden lg:block px-4 py-2 text-sm font-bold text-[#0d0c22] hover:text-[#ea4c89] transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-bold bg-[#0d0c22] text-white rounded-full hover:bg-[#ea4c89] transition-colors">Sign up</a>
            @endguest

            @auth
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                    <img 
                        src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->full_name).'&background=ea4c89&color=fff' }}" 
                        alt="{{ Auth::user()->full_name }}"
                        class="w-9 h-9 rounded-full object-cover border-2 border-transparent hover:border-[#ea4c89] transition-colors"
                    >
                </button>

                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-2xl shadow-xl py-2 z-50"
                >
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-bold text-[#0d0c22] truncate">{{ Auth::user()->full_name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        @if(in_array(Auth::user()->role, ['employer', 'admin']))
                            <span class="inline-block mt-1 text-xs px-2 py-0.5 bg-[#ea4c89]/10 text-[#ea4c89] rounded-full font-medium">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('user.profile', Auth::user()->username) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4]">Profile</a>
                    <a href="{{ route('applications.my') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4]">My Applications</a>
                    @if(in_array(Auth::user()->role, ['employer', 'admin']))
                        <a href="{{ route('jobs.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4]">Post a Job</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[#ea4c89] hover:bg-[#ea4c89]/10">Log Out</button>
                    </form>
                </div>
            </div>
            @endauth

            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-gray-500 hover:text-[#ea4c89] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileMenu" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>

    <div 
        x-show="mobileMenu" 
        x-transition
        class="lg:hidden absolute top-full left-0 right-0 bg-white border-b border-gray-200 px-4 py-4 z-40"
    >
        <div class="space-y-3">
            <a href="#" class="block py-2 text-base font-semibold text-[#0d0c22] hover:text-[#ea4c89] transition-colors">Explore</a>
            <a href="{{ route('jobs.index') }}" class="block py-2 text-base font-semibold text-[#0d0c22] hover:text-[#ea4c89] transition-colors">Get Hired</a>
            @if(in_array(Auth::user()->role ?? '', ['employer', 'admin']))
                <a href="{{ route('jobs.create') }}" class="block py-2 text-base font-semibold text-[#0d0c22] hover:text-[#ea4c89] transition-colors">Hire Talent</a>
            @endif
            
            @auth
                <a href="{{ route('user.profile', Auth::user()->username) }}" class="block py-2 text-base text-gray-600 hover:text-[#ea4c89]">Profile</a>
                <a href="{{ route('applications.my') }}" class="block py-2 text-base text-gray-600 hover:text-[#ea4c89]">My Applications</a>
                @if(in_array(Auth::user()->role, ['employer', 'admin']))
                    <a href="{{ route('jobs.create') }}" class="block py-2 text-base text-gray-600 hover:text-[#ea4c89]">Post a Job</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 text-base text-[#ea4c89] font-semibold hover:text-[#c73e72]">Log Out</button>
                </form>
            @else
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('login') }}" class="flex-1 text-center py-2 text-sm font-bold text-[#0d0c22] border border-gray-300 rounded-full hover:border-[#ea4c89] transition-colors">Log in</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center py-2 text-sm font-bold bg-[#ea4c89] text-white rounded-full hover:bg-[#c73e72] transition-colors">Sign up</a>
                </div>
            @endauth
        </div>
    </div>

</nav>

<div class="h-16 lg:h-14"></div>

<style>
    [x-cloak] { display: none !important; }
    nav.fixed { background-color: white !important; }
</style>