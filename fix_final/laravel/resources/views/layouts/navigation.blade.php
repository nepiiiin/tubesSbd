<nav 
    x-data="{ 
        mobileMenu: false, 
        showSearch: false,
        searchOpen: false
    }"
    @scroll.window="showSearch = (window.pageYOffset > 400)"
    class="fixed top-0 left-0 w-full z-50 bg-white !bg-white border-b border-gray-200 py-3 px-4 lg:px-6"
    :class="showSearch ? '' : ''"
>
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">

        <!-- ========== LOGO ========== -->
        <div class="flex-none">
            <a
                href="{{ route('home') }}"
                class="text-2xl font-bold tracking-tighter text-black hover:text-pink-500 transition-colors">
                dribbble
            </a>
        </div>

        <!-- ========== CENTER: SEARCH + CATEGORIES ========== -->
        <div class="flex-1 flex items-center justify-center min-w-0"
             :class="showSearch ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-4 pointer-events-none'"
        >
            
            <!-- Search Bar - Compact Dribbble Style -->
            <form 
                action="#" 
                method="GET" 
                class="hidden md:flex items-center bg-gray-100 rounded-full px-2 py-1.5 focus-within:ring-2 focus-within:ring-pink-200 transition-all max-w-xl w-full"
            >
                <!-- Search Input -->
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="What are you looking for?"
                    class="flex-1 bg-transparent border-none outline-none px-4 py-2 text-sm text-black placeholder-gray-500 min-w-0"
                >

                <!-- Filter Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button
                        type="button"
                        @click="open = !open"
                        class="flex items-center gap-1 px-3 py-2 text-sm font-semibold text-gray-600 hover:text-black border-l border-gray-300"
                    >
                        <span>Shots</span>
                        <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute bottom-full left-0 mb-2 w-40 bg-white border border-gray-200 rounded-xl shadow-lg py-1 z-50"
                    >
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Shots</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Designers</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Teams</a>
                    </div>
                </div>

                <!-- Search Button -->
                <button type="submit" class="ml-1 w-10 h-10 flex items-center justify-center bg-pink-500 hover:bg-pink-600 text-white rounded-full transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>

            <!-- Mobile Search Toggle -->
            <button 
                @click="searchOpen = !searchOpen"
                class="md:hidden p-2 text-gray-500 hover:text-black"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>

            <!-- Mobile Search Bar (Expandable) -->
            <div 
                x-show="searchOpen" 
                x-transition
                class="absolute top-full left-0 right-0 bg-white border-b border-gray-200 p-4 md:hidden z-40"
            >
                <form action="#" method="GET" class="flex items-center bg-gray-100 rounded-full px-4 py-2">
                    <input 
                        type="text" 
                        name="q" 
                        placeholder="Search shots, designers..." 
                        class="flex-1 bg-transparent border-none outline-none text-sm text-black"
                    >
                    <button type="submit" class="text-[#ea4c89] ml-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>

        <!-- ========== RIGHT: ACTIONS ========== -->
        <div class="flex-none flex items-center gap-2 lg:gap-4">

            <!-- Desktop Nav Links -->
            <div class="hidden lg:flex items-center gap-5">
                <a href="#" class="text-sm font-semibold text-black hover:text-pink-500 transition-colors">Explore</a>
                <a href="#" class="text-sm font-semibold text-black hover:text-pink-500 transition-colors">Hire</a>
                <a href="#" class="text-sm font-semibold text-black hover:text-pink-500 transition-colors">Get Hired</a>
            </div>

            <!-- Auth Buttons -->
            @guest
                <a href="{{ route('login') }}" class="hidden lg:block px-4 py-2 text-sm font-bold text-black hover:text-pink-500 transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-bold bg-black text-white rounded-full hover:bg-pink-500 transition-colors">Sign up</a>
            @endguest

            <!-- User Profile Dropdown -->
            @auth
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                    <img 
                        src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->full_name).'&background=ea4c89&color=fff' }}" 
                        alt="{{ Auth::user()->full_name }}"
                        class="w-9 h-9 rounded-full object-cover border-2 border-transparent hover:border-pink-500 transition-colors"
                    >
                </button>

                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-2xl shadow-xl py-2 z-50"
                >
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-bold text-black truncate">{{ Auth::user()->full_name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <a href="{{ route('user.profile', Auth::user()->username) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Out</button>
                    </form>
                </div>
            </div>
            @endauth

            <!-- Mobile Menu Button -->
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileMenu" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>

    <!-- ========== MOBILE MENU ========== -->
    <div 
        x-show="mobileMenu" 
        x-transition
        class="lg:hidden absolute top-full left-0 right-0 bg-white border-b border-gray-200 px-4 py-4 z-40"
    >
        <div class="space-y-3">
            <a href="#" class="block py-2 text-base font-semibold text-black">Explore</a>
            <a href="#" class="block py-2 text-base font-semibold text-black">Hire Talent</a>
            <a href="#" class="block py-2 text-base font-semibold text-black">Get Hired</a>
            @auth
                <a href="{{ route('user.profile', Auth::user()->username) }}" class="block py-2 text-base text-gray-600">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 text-base text-red-600 font-semibold">Log Out</button>
                </form>
            @else
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('login') }}" class="flex-1 text-center py-2 text-sm font-bold text-black border border-gray-300 rounded-full">Log in</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center py-2 text-sm font-bold bg-pink-500 text-white rounded-full">Sign up</a>
                </div>
            @endauth
        </div>

        @endauth

        @guest

        <a
            href="{{ route('login') }}"
            class="bg-pink-500 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-gray-800 transition-all">
            Log in
        </a>

        <a
            href="{{ route('register') }}"
            class="text-sm font-bold text-gray-700 hover:text-black">
            Sign up
        </a>

        @endguest

    </div>

</nav>

<!-- Spacer biar konten nggak ketutupan navbar fixed -->
<div class="h-16 lg:h-14"></div>

<style>
    [x-cloak] { display: none !important; }
    
    /* Force white background untuk navbar */
    nav.fixed {
        background-color: white !important;
    }
</style>