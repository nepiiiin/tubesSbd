<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="flex min-h-screen bg-white">
        
        <!-- Kolom Kiri (Form) -->
        <div class="w-full lg:w-[60%] flex flex-col relative px-8 py-10 sm:px-16 md:px-24">
            
            <!-- Logo Dribbble Mock -->
            <div class="absolute top-8 left-8 sm:top-12 sm:left-12">
                <span class="font-bold text-2xl italic tracking-tighter" style="font-family: cursive;">Dribbble</span>
            </div>

            <!-- Kontainer Tengah -->
            <div class="flex-1 flex flex-col justify-center items-center w-full max-w-sm mx-auto">
                
                <!-- Ikon Bola Pink -->
                <div class="mb-6">
                    <svg class="w-12 h-12 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.5 12C5.5 12 9 11 11.5 8.5C14 6 15 2.5 15 2.5"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.5 12C18.5 12 15 13 12.5 15.5C10 18 9 21.5 9 21.5"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 5.5C7.5 8 11 10 14.5 9.5C18 9 21 6.5 21 6.5"></path>
                    </svg>
                </div>

                <!-- Judul -->
                <h1 class="text-3xl font-bold mb-8 text-gray-900">Welcome back</h1>

                <!-- Tombol Google Login -->
                    <a href="#" class="w-full flex items-center justify-center gap-3 px-4 py-3.5 mb-6 border border-gray-300 rounded-full hover:bg-gray-50 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <!-- Ikon Google -->
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-900">Sign in with Google</span>
            </a>

                <!-- Separator 'or' -->
                <div class="flex items-center w-full mb-6">
                    <hr class="flex-1 border-gray-200">
                    <span class="px-4 text-sm text-gray-400">or</span>
                    <hr class="flex-1 border-gray-200">
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}" class="w-full space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter email or username" class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 bg-white placeholder:text-gray-400 text-gray-900 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 hover:border-gray-300 transition-all" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <!-- Catatan: Di gambar Dribbble hanya ada input email (sistem 2-step), tapi untuk Laravel default butuh password, jadi ditambahkan dengan style senada -->
                    <div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password" class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 bg-white placeholder:text-gray-400 text-gray-900 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 hover:border-gray-300 transition-all" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-[#0d0c22] text-white font-semibold rounded-full py-3.5 mt-2 hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                        Continue
                    </button>
                </form>

                <!-- Footer Text -->
                <p class="mt-6 text-xs text-center text-gray-500 max-w-[280px]">
                    By continuing, you agree to our <a href="#" class="underline hover:text-gray-800">Terms</a> and <a href="#" class="underline hover:text-gray-800">Privacy Policy</a>.
                </p>

                <p class="mt-6 text-sm text-center text-gray-600">
                    Don't have an account? 
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-[#0d0c22] underline hover:text-pink-500 transition-colors">Sign up</a>
                    @else
                        <a href="#" class="text-[#0d0c22] underline hover:text-pink-500 transition-colors">Sign up</a>
                    @endif
                </p>

                <!-- Forgot Password Link (Opsional jika dibutuhkan kembali) -->
                @if (Route::has('password.request'))
                    <a class="mt-4 text-xs text-gray-500 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>

        <!-- Kolom Kanan (Gambar Jamur) -->
        <!-- Gunakan gambar placeholder atau ganti URL dengan gambar lokal/aset kamu sendiri -->
        <div class="hidden lg:block w-[40%] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1618331835717-801e976710b2?q=80&w=1500&auto=format&fit=crop');">
            <!-- Bisa diisi dengan overlay warna jika perlu -->
        </div>

    </div>
</body>
</html>