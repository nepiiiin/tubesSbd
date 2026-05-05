<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Dribbble</title>
    <!-- Pastikan Tailwind CSS sudah terload di project kamu -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white antialiased">

    <!-- Main Container: Split Screen -->
    <div class="flex flex-col md:flex-row min-h-screen w-full">

        <!-- LEFT SIDE: FORM AREA -->
        <div class="w-full md:w-1/2 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 relative">
            
            <!-- Dribbble Text Logo (Top Left) -->
            <div class="absolute top-8 left-8">
                <span class="text-xl font-bold font-serif italic text-gray-900">Dribbble</span>
            </div>

            <div class="max-w-md w-full mx-auto mt-12">
                
                <!-- Dribbble Icon Logo (Center) -->
                <div class="flex justify-center mb-6">
                    <svg class="w-12 h-12 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                        <!-- Placeholder path, replace with actual Dribbble SVG path if you have it -->
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                    </svg>
                </div>

                <!-- Headings -->
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-2">
                    Welcome to Dribbble
                </h2>
                <p class="text-gray-600 text-center mb-8">
                    Create your account and discover world-class design talent.
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Continue with Google Button -->
                    <a href="{{ route('login') }}" class="flex items-center justify-center w-full px-4 py-3 border border-gray-300 rounded-full shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 mb-6">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Continue with Google
                    </a>

                    <!-- "or" Divider -->
                    <div class="relative mb-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">or</span>
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-6">
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               :value="old('email')" 
                               required 
                               autofocus 
                               autocomplete="username"
                               placeholder="Enter email address"
                               class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition duration-150 ease-in-out sm:text-sm">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Continue Button (Dark) -->
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition duration-150 ease-in-out mb-6">
                        Continue
                    </button>

                    <!-- Terms Text -->
                    <p class="text-xs text-center text-gray-500 mb-8">
                        By continuing, you agree to our 
                        <a href="#" class="underline hover:text-gray-700">Terms</a> and 
                        <a href="#" class="underline hover:text-gray-700">Privacy Policy</a>.
                    </p>

                    <!-- Sign In Link -->
                    <p class="text-center text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-gray-900 hover:text-gray-700 underline">
                            Sign in
                        </a>
                    </p>
                </form>
            </div>
        </div>

        <!-- RIGHT SIDE: IMAGE AREA -->
        <!-- GANTI URL GAMBAR DI BAWAH INI -->
        <div class="hidden md:block md:w-1/2 bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1518709766631-a6a7f45921c3?w=1200&q=80');">
            
            <!-- Optional: Overlay gelap tipis agar teks attribut terbaca -->
            <div class="absolute inset-0 bg-black/10"></div>

            <!-- Attribution Text (Pojok Kanan Bawah) -->
            <div class="absolute bottom-6 right-6 text-white text-sm font-medium drop-shadow-md">
                @glebich
            </div>
        </div>

    </div>

</body>
</html>