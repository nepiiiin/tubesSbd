<nav class="fixed top-0 left-0 w-full z-50 bg-white border-b border-gray-200 py-4 px-6 flex items-center justify-between">

    <!-- LOGO -->
    <div class="flex-none w-32">

        <a
            href="{{ auth()->check() ? route('dashboard') : route('home') }}"
            class="text-2xl font-bold tracking-tighter text-black hover:text-gray-700">
            dribbble
        </a>

    </div>

    <!-- CENTER -->
    <div class="flex items-center flex-1 justify-center min-w-0 px-4">

        <!-- DROPDOWN -->
        <div x-data="{ open: false }" class="relative flex-none mr-6">

            <button
                @click="open = !open"
                class="flex items-center font-bold text-sm border border-gray-200 rounded-xl px-4 py-2 hover:bg-gray-50 whitespace-nowrap focus:outline-none text-black bg-white">

                <span>New & Noteworthy</span>

                <svg
                    class="ml-2 w-4 h-4 transition-transform"
                    :class="open ? 'rotate-180' : ''"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"></path>

                </svg>

            </button>

            <!-- DROPDOWN CONTENT -->
            <div
                x-show="open"
                @click.away="open = false"
                x-transition
                class="absolute left-0 mt-2 w-56 bg-white border border-gray-200 rounded-2xl shadow-xl py-2 z-[9999]">

                <a
                    href="#"
                    class="block px-5 py-2 text-sm text-gray-600 hover:bg-gray-50">
                    Following
                </a>

                <a
                    href="#"
                    class="block px-5 py-2 text-sm text-gray-600 hover:bg-gray-50">
                    Popular
                </a>

                <hr class="my-1 border-gray-100">

                <a
                    href="#"
                    class="block px-5 py-2 text-sm font-bold text-gray-900 bg-gray-50 flex justify-between items-center">
                    New & Noteworthy
                </a>

            </div>

        </div>

        <!-- CATEGORY -->
        <div class="flex-1 overflow-hidden relative">

            <div class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

            <div class="flex items-center space-x-6 overflow-x-auto no-scrollbar scroll-smooth">

                <div class="flex items-center space-x-2 text-sm font-semibold whitespace-nowrap pr-10">

                    @foreach($categories as $category)

                    @php
                    $isDiscover = strtolower(trim($category->name)) === 'discover';


                    $url = $isDiscover
                    ? (auth()->check()
                    ? route('dashboard')
                    : route('home'))
                    : (auth()->check()
                    ? url('/category/' . $category->name)
                    : route('login'));

                    $isActive = $isDiscover
                    ? request()->is('/') || request()->is('dashboard')
                    : request()->is('category/'.$category->name);
                    @endphp

                    <a
                        href="{{ $url }}"
                        class="px-4 py-2 rounded-full transition-all
        {{ $isActive
            ? 'bg-pink-400 text-white'
            : 'text-black'
        }}">

                        {{ ucfirst(str_replace('-', ' ', $category->name)) }}

                    </a>

                    @endforeach
                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="flex-none flex items-center justify-end space-x-5 min-w-[300px]">

        <!-- SEARCH -->
        <!-- SEARCH -->
<form
    action="{{ route('search') }}"
    method="GET"
    class="relative group hidden xl:block"
>

    <span class="absolute inset-y-0 left-0 flex items-center pl-3">

        <svg
            class="w-4 h-4 text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
            </path>

        </svg>

    </span>

    <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="Search..."
        class="pl-10 pr-4 py-2 bg-gray-100 border-none rounded-full text-sm w-40 focus:ring-2 focus:ring-pink-100 focus:bg-white transition-all text-black"
    >

</form>d

        @auth

        <!-- MESSAGE -->
        <button class="text-gray-500 hover:text-black transition-colors">

            <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>

            </svg>

        </button>

        <!-- NOTIFICATION -->
        <button class="text-gray-500 hover:text-black transition-colors relative group focus:outline-none">

            <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>

            </svg>

            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-pink-500 ring-2 ring-white"></span>

        </button>

        <!-- PROFILE -->
        <div x-data="{ open: false }" class="relative flex-none">

            <button
                @click="open = !open"
                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition-all">

                <img
                    class="h-9 w-9 rounded-full object-cover"
                    src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->full_name).'&color=7F9CF5&background=EBF4FF' }}">

            </button>

            <!-- PROFILE DROPDOWN -->
            <div
                x-show="open"
                @click.away="open = false"
                x-transition
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-2xl shadow-xl py-2 z-[9999]">

                <div class="px-4 py-2 border-b border-gray-100">

                    <a
                        href="{{ route('user.profile', Auth::user()->username) }}"
                        class="block group">

                        <p class="text-sm font-bold text-gray-900 truncate group-hover:text-pink-500 transition-colors">
                            {{ Auth::user()->full_name }}
                        </p>

                        <p class="text-xs text-gray-500 truncate">
                            {{ Auth::user()->email }}
                        </p>

                    </a>

                </div>

                <a
                    href="{{ route('user.profile', Auth::user()->username) }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    My Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        Log Out
                    </button>

                </form>

            </div>

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

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>