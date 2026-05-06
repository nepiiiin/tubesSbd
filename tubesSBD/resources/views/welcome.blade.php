<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dribbble - Discover the World's Top Designers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dribbble: {
                            pink: '#ea4c89',
                            dark: '#0d0c22',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white text-black">

    <!-- ==================== NAVIGATION ==================== -->
    <nav class="border-b border-gray-200 bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="mr-10">
                        <svg class="w-8 h-8 text-dribbble-pink" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm9.817 11.424a10.182 10.182 0 01.058 1.076c-2.027-.422-3.847-.463-5.49-.156-.203-.477-.41-.95-.62-1.418 1.94-.84 3.454-2.046 4.535-3.642a10.168 10.168 0 011.517 4.14zM12 1.824c2.366 0 4.526.87 6.183 2.304-.986 1.445-2.37 2.534-4.167 3.278a47.926 47.926 0 00-3.286-5.546c.417-.024.84-.036 1.27-.036zM8.42 2.978a46.27 46.27 0 013.334 5.648c-2.426.643-5.252.847-8.49.61A10.188 10.188 0 018.42 2.978zM1.824 12c0-.223.009-.444.026-.663 3.59.266 6.726.024 9.395-.726.175.383.344.768.508 1.153-3.05.885-5.593 2.648-7.626 5.282A10.156 10.156 0 011.824 12zm4.01 9.12a10.177 10.177 0 01-1.92-1.68c1.825-2.446 4.133-4.056 6.94-4.827.78 2.106 1.41 4.29 1.88 6.54a10.166 10.166 0 01-6.9-1.033zm8.736.444c-.44-2.12-1.026-4.18-1.756-6.174 1.52-.21 3.207-.107 5.07.314a10.177 10.177 0 01-3.314 5.86z"/>
                        </svg>
                    </a>

                    <!-- Menu Items -->
                    <div class="hidden md:flex items-center space-x-8">
                        
                        <!-- EXPLORE DROPDOWN (FIX VERSION) -->
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="flex items-center space-x-1 text-black font-medium hover:text-dribbble-pink transition">
                                <span>Explore</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Dropdown dengan Jembatan Transparan -->
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 class="absolute left-0 top-full w-64 z-50">
                                
                                <!-- pt-4 ini adalah "jembatan transparan" -->
                                <div class="pt-4">
                                    <div class="bg-white rounded-xl shadow-2xl border border-gray-100 py-2 overflow-hidden">
                                        
                                        <div class="px-2">
                                            <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">
                                                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                                Popular
                                            </a>
                                            <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">
                                                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                                New and Noteworthy
                                            </a>
                                        </div>

                                        <div class="my-2 border-t border-gray-100 mx-2"></div>

                                        <div class="px-2 space-y-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">Product Design</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">Web Design</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">Animation</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">Branding</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">Illustration</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">Mobile</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">Typography</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-black rounded-lg hover:bg-gray-50 hover:text-dribbble-pink transition">Print</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Lainnya -->
                        <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="flex items-center space-x-1 text-black font-medium hover:text-dribbble-pink transition">
                                <span>Hire Talent</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </div>

                        <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="flex items-center space-x-1 text-black font-medium hover:text-dribbble-pink transition">
                                <span>Get Hired</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </div>

                        <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="flex items-center space-x-1 text-black font-medium hover:text-dribbble-pink transition">
                                <span>Community</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="/register" class="hidden md:block text-black font-medium hover:text-dribbble-pink transition">Sign up</a>
                    <a href="/login" class="bg-dribbble-dark text-white px-6 py-2.5 rounded-full font-medium hover:bg-dribbble-pink transition duration-300 shadow-lg shadow-gray-200">Log in</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ==================== HERO SECTION ==================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Content -->
            <div>
                <h1 class="text-5xl lg:text-6xl font-bold text-black leading-tight mb-6">
                    Discover the World's Top Designers
                </h1>
                
                <p class="text-xl text-black mb-8 leading-relaxed">
                    Explore work from the most talented and accomplished designers ready to take on your next project.
                </p>

                <!-- Tabs -->
                <div class="flex space-x-2 mb-6">
                    <button class="flex items-center space-x-2 bg-dribbble-dark text-white px-5 py-3 rounded-full font-medium transition hover:bg-dribbble-pink">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Shots</span>
                    </button>
                    <button class="flex items-center space-x-2 text-black hover:text-dribbble-pink px-5 py-3 rounded-full font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Designers</span>
                    </button>
                    <button class="flex items-center space-x-2 text-black hover:text-dribbble-pink px-5 py-3 rounded-full font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Services</span>
                    </button>
                </div>

                <!-- Search Bar -->
                <div class="relative mb-6">
                    <input 
                        type="text" 
                        placeholder="What type of design are you interested in?"
                        class="w-full pl-6 pr-14 py-4 bg-gray-100 rounded-full text-lg focus:outline-none focus:ring-2 focus:ring-dribbble-pink focus:bg-white transition"
                    >
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-dribbble-pink text-white p-3 rounded-full hover:bg-pink-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>

                <!-- Popular Tags -->
                <div class="flex items-center space-x-3 flex-wrap">
                    <span class="font-semibold text-black">Popular:</span>
                    <button class="px-4 py-2 border border-gray-300 rounded-full text-sm text-black hover:border-dribbble-pink hover:text-dribbble-pink transition">dashboard</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-full text-sm text-black hover:border-dribbble-pink hover:text-dribbble-pink transition">landing page</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-full text-sm text-black hover:border-dribbble-pink hover:text-dribbble-pink transition">e-commerce</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-full text-sm text-black hover:border-dribbble-pink hover:text-dribbble-pink transition">logo</button>
                </div>
            </div>

            <!-- Right Content - Image Showcase -->
            <div class="relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img 
                        src="https://images.unsplash.com/photo-1634947928054-8b14c5d9e3e6?w=800&h=600&fit=crop" 
                        alt="Design Showcase" 
                        class="w-full h-auto"
                    >
                    <!-- Overlay Elements -->
                    <div class="absolute top-4 left-4">
                        <div class="bg-white/90 backdrop-blur-sm rounded-lg px-3 py-2 flex items-center space-x-2">
                            <div class="flex -space-x-2">
                                <div class="w-6 h-6 rounded-full bg-dribbble-pink"></div>
                                <div class="w-6 h-6 rounded-full bg-purple-500"></div>
                                <div class="w-6 h-6 rounded-full bg-blue-500"></div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button class="bg-white/90 backdrop-blur-sm rounded-lg px-3 py-2 text-sm font-medium hover:bg-white transition">
                            / MENU
                        </button>
                    </div>
                    <!-- Designer Info -->
                    <div class="absolute bottom-4 right-4 bg-white rounded-full px-4 py-2 flex items-center space-x-2 shadow-lg">
                        <img 
                            src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face" 
                            alt="Designer" 
                            class="w-8 h-8 rounded-full object-cover"
                        >
                        <span class="font-medium text-sm text-black">negi design</span>
                    </div>
                </div>
                
                <!-- Decorative Background -->
                <div class="absolute -z-10 inset-0 bg-gradient-to-br from-orange-400 via-pink-300 to-purple-300 rounded-3xl transform rotate-3 opacity-60"></div>
            </div>
        </div>
    </div>

    <!-- ==================== FEATURED SECTION ==================== -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-black text-center mb-12">Featured Shots</h2>
            
            <!-- Grid Shots -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for($i = 1; $i <= 8; $i++)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300 group cursor-pointer">
                    <div class="relative overflow-hidden">
                        <img 
                            src="https://picsum.photos/400/300?random={{ $i }}" 
                            alt="Shot {{ $i }}"
                            class="w-full h-64 object-cover group-hover:scale-105 transition duration-500"
                        >
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-black">Design Project {{ $i }}</h3>
                        <p class="text-sm text-black mt-1">by Designer {{ $i }}</p>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center space-x-4 text-sm text-black">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                                    {{ rand(10, 500) }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                    {{ rand(100, 5000) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="bg-white border-2 border-dribbble-pink text-dribbble-pink px-8 py-3 rounded-full font-semibold hover:bg-dribbble-pink hover:text-white transition duration-300">
                    Load More Shots
                </button>
            </div>
        </div>
    </div>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-dribbble-dark text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-4">For Designers</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition">Go Pro!</a></li>
                        <li><a href="#" class="hover:text-white transition">Explore Design Work</a></li>
                        <li><a href="#" class="hover:text-white transition">Design Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Podcast</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Hire Designers</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition">Post a Job Opening</a></li>
                        <li><a href="#" class="hover:text-white transition">Post a Freelance Project</a></li>
                        <li><a href="#" class="hover:text-white transition">Search for Designers</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Company</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition">About</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition">Support</a></li>
                        <li><a href="#" class="hover:text-white transition">Media Kit</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Directories</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition">Design Jobs</a></li>
                        <li><a href="#" class="hover:text-white transition">Designers for Hire</a></li>
                        <li><a href="#" class="hover:text-white transition">Freelance Projects</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2026 Dribbble Clone. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>