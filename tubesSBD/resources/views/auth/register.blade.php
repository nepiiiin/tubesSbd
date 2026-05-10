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
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-black overflow-hidden">

    <div class="min-h-screen flex">

        <!-- LEFT SIDE -->
        <div class="w-full lg:w-[45%] flex flex-col justify-center px-6 sm:px-12 lg:px-20 relative bg-white">

            <!-- Logo -->
            <a href="/" class="absolute top-8 left-8">
                <svg class="w-8 h-8 text-pink-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0z"/>
                </svg>
            </a>

            <div class="max-w-md w-full mx-auto">

                <!-- Icon -->
                <svg class="mx-auto w-12 h-12 text-pink-500 mb-6" viewBox="0 0 40 40" fill="currentColor">
                    <circle cx="20" cy="20" r="20"/>
                </svg>

                <!-- Heading -->
                <h1 class="text-4xl font-bold text-[#0d0c22] mb-3 text-center">
                    Discover the world’s top Designers & Creatives
                </h1>

                <p class="text-gray-500 text-center mb-8">
                    Dribbble is the leading destination to find & showcase creative work.
                </p>

                <!-- Google Button -->
                <button class="w-full border border-gray-300 rounded-full py-3 flex items-center justify-center gap-3 hover:bg-gray-50 transition mb-5">

                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>

                    <span class="font-medium text-sm">
                        Continue with Google
                    </span>
                </button>

                <!-- Divider -->
                <div class="flex items-center gap-4 mb-5">
                    <div class="h-px bg-gray-200 flex-1"></div>
                    <span class="text-gray-400 text-sm">or</span>
                    <div class="h-px bg-gray-200 flex-1"></div>
                </div>

                <!-- FORM -->
                <form action="{{ route('register') }}" method="POST">

                    @csrf

                    <!-- Name -->
                    <input
                        type="text"
                        name="name"
                        placeholder="Full Name"
                        class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:outline-none focus:ring-2 focus:ring-pink-500 mb-4"
                        required
                    >

                    <!-- Username -->
                     <input
                        type="text"
                        name="username"
                        placeholder="Username"
                        class="w_full border border-gray-300 rounded-xl px-4 py-4 focus:outline-none focus:ring-2 focus:ring-pink-500 mb-4"
                            required
                        >

                    <!-- Email -->
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:outline-none focus:ring-2 focus:ring-pink-500 mb-4"
                        required
                    >

                    <!-- Password -->
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:outline-none focus:ring-2 focus:ring-pink-500 mb-4"
                        required
                    >

                    <!-- Confirm Password -->
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:outline-none focus:ring-2 focus:ring-pink-500 mb-5"
                        required
                    >

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="w-full bg-[#0d0c22] hover:bg-pink-500 transition text-white py-4 rounded-full font-semibold mb-6"
                    >
                        Create Account
                    </button>

                </form>

                <!-- Terms -->
                <p class="text-xs text-gray-500 text-center leading-relaxed">
                    By creating an account you agree with our
                    <a href="#" class="underline">Terms of Service</a>,
                    <a href="#" class="underline">Privacy Policy</a>,
                    and default
                    <a href="#" class="underline">Notification Settings</a>.
                </p>

                <!-- Login -->
                <p class="text-sm text-center text-gray-500 mt-6">
                    Already have an account?
                    <a href="/login" class="text-pink-500 font-medium hover:underline">
                        Sign in
                    </a>
                </p>

            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="hidden lg:block lg:w-[55%] relative">

            <img
                src="https://images.unsplash.com/photo-1614850523459-c2f4c699c52e?q=80&w=1600&auto=format&fit=crop"
                class="w-full h-screen object-cover"
                alt="Artwork"
            >

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/10"></div>

            <!-- Text -->
            <div class="absolute bottom-10 left-10 text-white max-w-lg">

                <h2 class="text-4xl font-bold leading-tight mb-4">
                    Discover the world’s top Designers & Creatives.
                </h2>

                <p class="text-lg opacity-90">
                    Art by Gleb Kuznetsov
                </p>

            </div>

        </div>

    </div>

</body>
</html>