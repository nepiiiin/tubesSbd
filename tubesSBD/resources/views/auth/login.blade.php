<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Dribbble</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dribbble: { pink: '#ea4c89', dark: '#0d0c22' }
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-black">

    <div class="min-h-screen flex">
        
        <!-- ================= LEFT: FORM AREA ================= -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-6 sm:px-12 lg:px-20 relative">
            
            <!-- Logo Top Left -->
            <a href="/" class="absolute top-8 left-8">
                <svg class="w-8 h-8 text-dribbble-pink" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm9.817 11.424a10.182 10.182 0 01.058 1.076c-2.027-.422-3.847-.463-5.49-.156-.203-.477-.41-.95-.62-1.418 1.94-.84 3.454-2.046 4.535-3.642a10.168 10.168 0 011.517 4.14zM12 1.824c2.366 0 4.526.87 6.183 2.304-.986 1.445-2.37 2.534-4.167 3.278a47.926 47.926 0 00-3.286-5.546c.417-.024.84-.036 1.27-.036zM8.42 2.978a46.27 46.27 0 013.334 5.648c-2.426.643-5.252.847-8.49.61A10.188 10.188 0 018.42 2.978zM1.824 12c0-.223.009-.444.026-.663 3.59.266 6.726.024 9.395-.726.175.383.344.768.508 1.153-3.05.885-5.593 2.648-7.626 5.282A10.156 10.156 0 011.824 12zm4.01 9.12a10.177 10.177 0 01-1.92-1.68c1.825-2.446 4.133-4.056 6.94-4.827.78 2.106 1.41 4.29 1.88 6.54a10.166 10.166 0 01-6.9-1.033zm8.736.444c-.44-2.12-1.026-4.18-1.756-6.174 1.52-.21 3.207-.107 5.07.314a10.177 10.177 0 01-3.314 5.86z"/>
                </svg>
            </a>

            <div class="max-w-md w-full text-center">
                
                <!-- Center Icon -->
                <svg class="mx-auto w-12 h-12 text-dribbble-pink mb-6" viewBox="0 0 40 40" fill="currentColor">
                    <path d="M20 0C8.954 0 0 8.954 0 20s8.954 20 20 20 20-8.954 20-20S31.046 0 20 0zm16.176 18.97c.092 1.08.13 2.186.102 3.308-3.238-.688-6.175-.754-8.784-.258-.324-.778-.656-1.55-.994-2.316 3.104-1.372 5.528-3.344 7.264-5.926 1.388 1.524 2.266 3.318 2.412 5.192zM20 2.88c3.786 0 7.242 1.392 9.894 3.686-1.578 2.356-3.792 4.136-6.668 5.346a77.23 77.23 0 00-5.26-9.03c.666-.038 1.344-.058 2.034-.058zM13.472 4.766a73.84 73.84 0 015.336 9.216c-3.882 1.042-8.404 1.374-13.584 1.004A16.302 16.302 0 0113.472 4.766zM2.88 20c0-.356.014-.71.042-1.06 5.744.432 10.762.038 15.032-1.17.28.626.552 1.254.814 1.89-4.88 1.44-8.948 4.304-12.204 8.59A16.25 16.25 0 012.88 20zm6.416 14.764a16.282 16.282 0 01-3.072-2.72c2.92-3.986 6.614-6.602 11.104-7.844 1.248 3.426 2.256 7.006 3.01 10.666a16.266 16.266 0 01-11.042-1.66zm13.976.712c-.704-3.444-1.642-6.804-2.81-10.046 2.432-.34 5.13-.174 8.112.51a16.282 16.282 0 01-5.302 9.536z"/>
                </svg>

                <h1 class="text-3xl font-bold mb-3">Welcome to Dribbble</h1>
                <p class="text-black mb-8 leading-relaxed">Create your account and discover world-class design talent.</p>

                <!-- Google Sign In Button -->
                <button class="w-full flex items-center justify-between gap-3 border border-gray-300 rounded-full py-3.5 px-5 hover:bg-gray-50 transition mb-6 group text-left">
                    <div class="flex items-center gap-3">
                        <!-- Google G Icon -->
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-sm text-black">Lanjutkan sebagai Siti Naifah</p>
                            <p class="text-xs text-gray-500">sitinaifahbatubara@gmail.com</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- OR Divider -->
                <div class="relative flex items-center justify-center my-6">
                    <div class="border-t border-gray-200 w-full absolute"></div>
                    <span class="bg-white px-4 text-sm text-gray-500 relative">or</span>
                </div>

                <!-- Email Input -->
                <input type="email" placeholder="Enter email address" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-dribbble-pink focus:border-transparent transition mb-4 text-black placeholder-gray-400">

                <!-- Continue Button -->
                <button class="w-full bg-dribbble-dark text-white font-semibold py-4 rounded-full hover:bg-dribbble-pink transition duration-300 mb-6">Continue</button>

                <!-- Terms & Privacy -->
                <p class="text-sm text-gray-500 mb-6">
                    By continuing, you agree to our <a href="#" class="underline text-gray-600 hover:text-dribbble-pink">Terms</a> and <a href="#" class="underline text-gray-600 hover:text-dribbble-pink">Privacy Policy</a>.
                </p>

                <!-- Sign In Link -->
                <p class="text-sm text-gray-500">
                    Already have an account? <a href="#" class="font-medium text-dribbble-pink hover:underline">Sign in</a>
                </p>
            </div>
        </div>

        <!-- ================= RIGHT: IMAGE AREA ================= -->
        <div class="hidden lg:block lg:w-1/2 relative bg-gray-100 overflow-hidden">
            <!-- Ganti URL gambar ini dengan aset kamu sendiri -->
            <img src="https://images.unsplash.com/photo-1614850523459-c2f4c699c52e?w=1200&h=1600&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover" 
                 alt="Creative Artwork">
            
            <!-- Credit Watermark -->
            <span class="absolute bottom-6 right-6 text-white text-sm font-medium drop-shadow-lg">@glebich</span>
        </div>

    </div>

</body>
</html>