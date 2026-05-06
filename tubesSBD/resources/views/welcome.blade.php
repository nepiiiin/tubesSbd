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
                        
                        <!-- EXPLORE DROPDOWN -->
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="flex items-center space-x-1 text-black font-medium hover:text-dribbble-pink transition">
                                <span>Explore</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 class="absolute left-0 top-full w-64 z-50">
                                
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

                        <!-- HIRE TALENT DROPDOWN -->
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="flex items-center space-x-1 text-black font-medium hover:text-dribbble-pink transition">
                                <span>Hire Talent</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 class="absolute left-0 top-full w-[720px] z-50">
                                
                                <div class="pt-4">
                                    <div class="bg-white rounded-xl shadow-2xl border border-gray-100 p-6 overflow-hidden">
                                        <div class="grid grid-cols-2 gap-8">
                                            
                                            <!-- Kolom Kiri -->
                                            <div class="space-y-6">
                                                <a href="#" class="flex items-start space-x-4 group">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-dribbble-pink group-hover:text-white transition">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-semibold text-black group-hover:text-dribbble-pink transition">Start Project Brief</h3>
                                                        <p class="text-sm text-gray-500 mt-1">Get recommendations and proposals</p>
                                                    </div>
                                                </a>

                                                <a href="#" class="flex items-start space-x-4 group">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-dribbble-pink group-hover:text-white transition">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-semibold text-black group-hover:text-dribbble-pink transition">Browse Profiles</h3>
                                                        <p class="text-sm text-gray-500 mt-1">Find and message talent directly</p>
                                                    </div>
                                                </a>

                                                <a href="#" class="flex items-start space-x-4 group">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-dribbble-pink group-hover:text-white transition">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-semibold text-black group-hover:text-dribbble-pink transition">Explore Services</h3>
                                                        <p class="text-sm text-gray-500 mt-1">Hire quickly with pre-packaged services</p>
                                                    </div>
                                                </a>
                                            </div>

                                            <!-- Kolom Kanan -->
                                            <div class="space-y-6">
                                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition group">
                                                    <span class="font-medium text-black group-hover:text-dribbble-pink transition">Browse Design Agencies</span>
                                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-dribbble-pink transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                    </svg>
                                                </a>

                                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition group">
                                                    <span class="font-medium text-black group-hover:text-dribbble-pink transition">Post a Full-Time Job</span>
                                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-dribbble-pink transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                    </svg>
                                                </a>

                                                <div class="pt-4 mt-4 border-t border-gray-200">
                                                    <a href="#" class="flex items-center text-sm text-gray-600 hover:text-dribbble-pink transition group">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        Learn more about how hiring works on Dribbble
                                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- GET HIRED DROPDOWN -->
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="flex items-center space-x-1 text-black font-medium hover:text-dribbble-pink transition">
                                <span>Get Hired</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 class="absolute left-0 top-full w-[720px] z-50">
                                
                                <div class="pt-4">
                                    <div class="bg-white rounded-xl shadow-2xl border border-gray-100 p-6 overflow-hidden">
                                        <div class="grid grid-cols-2 gap-8">
                                            
                                            <!-- Kolom Kiri -->
                                            <div class="space-y-6">
                                                <a href="#" class="flex items-start space-x-4 group">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-dribbble-pink group-hover:text-white transition">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-semibold text-black group-hover:text-dribbble-pink transition">Browse Project Briefs</h3>
                                                        <p class="text-sm text-gray-500 mt-1">Pitch clients ready to hire now</p>
                                                    </div>
                                                </a>

                                                <a href="#" class="flex items-start space-x-4 group">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-dribbble-pink group-hover:text-white transition relative">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                        </svg>
                                                        <span class="absolute -top-1 -right-1 bg-dribbble-pink text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">NEW</span>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-semibold text-black group-hover:text-dribbble-pink transition">Send Outbound Proposal</h3>
                                                        <p class="text-sm text-gray-500 mt-1">Send proposals to any client</p>
                                                    </div>
                                                </a>

                                                <a href="#" class="flex items-start space-x-4 group">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-dribbble-pink group-hover:text-white transition">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-semibold text-black group-hover:text-dribbble-pink transition">Add Service</h3>
                                                        <p class="text-sm text-gray-500 mt-1">Let clients purchase your services</p>
                                                    </div>
                                                </a>
                                            </div>

                                            <!-- Kolom Kanan -->
                                            <div class="space-y-6">
                                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition group">
                                                    <span class="font-medium text-black group-hover:text-dribbble-pink transition">Full-Time Jobs</span>
                                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-dribbble-pink transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                    </svg>
                                                </a>

                                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition group">
                                                    <span class="font-medium text-black group-hover:text-dribbble-pink transition">Upgrade to Pro</span>
                                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-dribbble-pink transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                    </svg>
                                                </a>

                                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition group">
                                                    <span class="font-medium text-black group-hover:text-dribbble-pink transition">Advertise with Us</span>
                                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-dribbble-pink transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                    </svg>
                                                </a>

                                                <div class="pt-4 mt-4 border-t border-gray-200">
                                                    <a href="#" class="flex items-center text-sm text-gray-600 hover:text-dribbble-pink transition group">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        Learn more about getting hired on Dribbble
                                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- COMMUNITY DROPDOWN -->
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="flex items-center space-x-1 text-black font-medium hover:text-dribbble-pink transition">
                                <span>Community</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 class="absolute left-0 top-full w-[560px] z-50">
                                
                                <div class="pt-4">
                                    <div class="bg-white rounded-xl shadow-2xl border border-gray-100 p-6 overflow-hidden">
                                        
                                        <div class="space-y-6 mb-6">
                                            <a href="#" class="flex items-start space-x-4 group">
                                                <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-dribbble-pink group-hover:text-white transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-9 6h6"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="font-semibold text-black group-hover:text-dribbble-pink transition">Blog</h3>
                                                    <p class="text-sm text-gray-500 mt-1">Design inspiration, stories, and tips</p>
                                                </div>
                                            </a>

                                            <a href="#" class="flex items-start space-x-4 group">
                                                <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-dribbble-pink group-hover:text-white transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="font-semibold text-black group-hover:text-dribbble-pink transition">Playoffs</h3>
                                                    <p class="text-sm text-gray-500 mt-1">Join creative challenges and show your skills</p>
                                                </div>
                                            </a>

                                            <a href="#" class="flex items-start space-x-4 group">
                                                <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-dribbble-pink group-hover:text-white transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="font-semibold text-black group-hover:text-dribbble-pink transition">Help Center</h3>
                                                    <p class="text-sm text-gray-500 mt-1">Get quick answers and learn how to use Dribbble</p>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- Social Media Icons -->
                                        <div class="pt-6 mt-6 border-t border-gray-200">
                                            <p class="text-sm text-gray-500 mb-4">Follow Us</p>
                                            <div class="flex items-center space-x-4">
                                                <!-- Instagram -->
                                                <a href="https://instagram.com/dribbble" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-dribbble-pink hover:text-white transition">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                                    </svg>
                                                </a>
                                                
                                                <!-- X/Twitter -->
                                                <a href="https://twitter.com/dribbble" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-dribbble-pink hover:text-white transition">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                                    </svg>
                                                </a>
                                                
                                                <!-- Pinterest -->
                                                <a href="https://pinterest.com/dribbble" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-dribbble-pink hover:text-white transition">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z"/>
                                                    </svg>
                                                </a>
                                                
                                                <!-- YouTube -->
                                                <a href="https://youtube.com/dribbble" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-dribbble-pink hover:text-white transition">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                    </svg>
                                                </a>
                                                
                                                <!-- TikTok -->
                                                <a href="https://tiktok.com/@dribbble" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-dribbble-pink hover:text-white transition">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                                    </svg>
                                                </a>
                                                
                                                <!-- Threads -->
                                                <a href="https://threads.net/@dribbble" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-dribbble-pink hover:text-white transition">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.447 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.44 2.525-8.482 1.85-2.304 4.604-3.485 8.184-3.509h.04c2.746.02 4.996.751 6.693 2.168 1.56 1.303 2.628 3.167 3.179 5.534l.004.016v3.938l-.004.016c-.55 2.367-1.619 4.231-3.179 5.534-1.697 1.417-3.947 2.148-6.693 2.168h-.035zm-6.03-18.31C4.717 7.47 3.958 9.692 3.928 12c.03 2.308.79 4.53 2.228 6.31 1.477 1.83 3.724 2.762 6.666 2.782 2.25-.018 4.06-.59 5.383-1.698 1.165-.974 1.973-2.378 2.405-4.162v-3.464c-.432-1.784-1.24-3.188-2.405-4.162-1.323-1.108-3.133-1.68-5.383-1.698-2.942.02-5.189.952-6.666 2.782z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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