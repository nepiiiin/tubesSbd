<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>For Designers - Dribbble</title>
    
    <!-- Menggunakan Setup Tailwind & Alpine yang SAMA dengan welcome.blade.php -->
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
<body class="bg-white text-black antialiased">

    <!-- ==================== NAVIGATION (Sama seperti Welcome) ==================== -->
    <nav class="border-b border-gray-200 bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="mr-10 group">
                        <!-- Logo SVG Dribbble -->
                        <svg class="w-8 h-8 text-dribbble-pink group-hover:opacity-80 transition" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm9.817 11.424a10.182 10.182 0 01.058 1.076c-2.027-.422-3.847-.463-5.49-.156-.203-.477-.41-.95-.62-1.418 1.94-.84 3.454-2.046 4.535-3.642a10.168 10.168 0 011.517 4.14zM12 1.824c2.366 0 4.526.87 6.183 2.304-.986 1.445-2.37 2.534-4.167 3.278a47.926 47.926 0 00-3.286-5.546c.417-.024.84-.036 1.27-.036zM8.42 2.978a46.27 46.27 0 013.334 5.648c-2.426.643-5.252.847-8.49.61A10.188 10.188 0 018.42 2.978zM1.824 12c0-.223.009-.444.026-.663 3.59.266 6.726.024 9.395-.726.175.383.344.768.508 1.153-3.05.885-5.593 2.648-7.626 5.282A10.156 10.156 0 011.824 12zm4.01 9.12a10.177 10.177 0 01-1.92-1.68c1.825-2.446 4.133-4.056 6.94-4.827.78 2.106 1.41 4.29 1.88 6.54a10.166 10.166 0 01-6.9-1.033zm8.736.444c-.44-2.12-1.026-4.18-1.756-6.174 1.52-.21 3.207-.107 5.07.314a10.177 10.177 0 01-3.314 5.86z"/>
                        </svg>
                    </a>

                    <!-- Menu Items (Disederhanakan untuk halaman ini, tapi struktur sama) -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#" class="text-black font-medium hover:text-dribbble-pink transition flex items-center gap-1">Explore <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></a>
                        <a href="#" class="text-black font-medium hover:text-dribbble-pink transition flex items-center gap-1">Hire Talent <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></a>
                        <a href="#" class="text-black font-medium hover:text-dribbble-pink transition flex items-center gap-1">Get Hired <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></a>
                        <a href="#" class="text-black font-medium hover:text-dribbble-pink transition flex items-center gap-1">Community <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></a>
                    </div>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="hidden sm:inline-block border border-gray-300 rounded-full px-4 py-2 text-sm font-medium hover:bg-gray-50 transition">Start Project Brief</a>
                    
                    <!-- Icons -->
                    <a href="#" class="text-gray-600 hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </a>
                    
                    <!-- Avatar Placeholder -->
                    <div class="h-9 w-9 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold cursor-pointer hover:ring-2 hover:ring-offset-2 hover:ring-purple-600 transition">
                        D
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- ==================== HERO SECTION (For Designers) ==================== -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Content: Text -->
            <div class="space-y-8 order-2 lg:order-1">
                <span class="text-dribbble-pink font-bold uppercase tracking-wider text-sm">
                    For Designers
                </span>
                
                <h1 class="text-5xl lg:text-6xl font-bold leading-tight text-dribbble-dark">
                    Join the world’s<br>
                    best creative<br>
                    community
                </h1>
                
                <p class="text-xl text-gray-600 max-w-lg leading-relaxed">
                    Build your brand, grow your skills, and land your dream projects all on Dribbble.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <!-- Tombol Utama (Hitam) -->
                    <a href="/register" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-medium rounded-full text-white bg-dribbble-dark hover:bg-gray-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Create your profile
                    </a>
                    
                    <!-- Link Sekunder (Underline) -->
                    <a href="#" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-medium rounded-full text-dribbble-dark hover:bg-gray-100 transition underline decoration-gray-400 hover:decoration-dribbble-dark underline-offset-4">
                        Hiring designers?
                    </a>
                </div>
            </div>

            <!-- Right Content: Image -->
            <div class="relative lg:h-[600px] w-full order-1 lg:order-2">
                <!-- Gambar Placeholder (Ganti src dengan gambar lokal kamu nanti) -->
                <!-- Saya pakai gambar Unsplash yang mirip suasana kantor/desain -->
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                     alt="Designers collaborating" 
                     class="w-full h-full object-cover rounded-2xl shadow-2xl">
                
                <!-- Credit Badge (Opsional, mirip screenshot) -->
                <div class="absolute bottom-6 right-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full text-xs font-bold text-gray-800 shadow-sm flex items-center gap-2">
                    <span>@Hoodzpan</span>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer Sederhana (Bisa copy footer dari welcome jika mau lengkap) -->
    <footer class="border-t border-gray-200 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; 2026 Dribbble Clone. All rights reserved.
        </div>
    </footer>

</body>
</html>