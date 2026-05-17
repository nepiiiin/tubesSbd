<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dribbble</title>

    @vite(['resources/css/app.css'])

    <style>
        .dribbble-logo-ball{
            animation:spin 8s linear infinite;
        }

        @keyframes spin{
            from{ transform:rotate(0deg); }
            to{ transform:rotate(360deg); }
        }

        .bg-image{
            animation:zoom 15s ease-in-out infinite alternate;
        }

        @keyframes zoom{
            from{ transform:scale(1); }
            to{ transform:scale(1.08); }
        }

        .circle{
            animation:float 7s ease-in-out infinite;
        }

        .circle2{
            animation-delay:2s;
        }

        .circle3{
            animation-delay:4s;
        }

        @keyframes float{
            0%{ transform:translateY(0px); }
            50%{ transform:translateY(-25px); }
            100%{ transform:translateY(0px); }
        }
    </style>
</head>

<body class="w-full min-h-screen bg-white dark:bg-[#071025] overflow-y-auto transition-colors duration-300">

<div class="w-full min-h-screen flex flex-col lg:flex-row">

    <!-- LEFT -->
    <div class="w-full lg:w-[65%] bg-white dark:bg-[#071025] relative flex justify-center items-center px-[30px] py-[50px] transition-colors duration-300">

        <!-- LOGO -->
        <a
            href="{{ route('home') }}"
            class="absolute top-[30px] left-[40px] text-[28px] italic font-bold text-gray-900 dark:text-white no-underline transition duration-300 hover:text-[#d89ae4]"
        >
            Dribbble
        </a>

        <!-- FORM WRAPPER -->
        <div class="w-full max-w-[420px]">

            <!-- Dribbble Ball -->
            <div class="dribbble-logo-ball relative w-[52px] h-[52px] border-[3px] border-[#d89ae4] rounded-full mx-auto mb-[18px]">

                <div class="absolute w-[58px] h-[22px] top-[12px] left-[-6px] border-[2px] border-[#d89ae4] rounded-full border-l-0 border-r-0"></div>

                <div class="absolute w-[18px] h-[52px] left-[15px] top-[-3px] border-[2px] border-[#d89ae4] rounded-full border-t-0 border-b-0 rotate-[25deg]"></div>

                <div class="absolute w-[18px] h-[52px] right-[15px] top-[-3px] border-[2px] border-[#d89ae4] rounded-full border-t-0 border-b-0 -rotate-[25deg]"></div>

                <div class="absolute w-[50px] h-[50px] top-[-2px] left-[-2px] border-[2px] border-[#d89ae4] rounded-full border-t-0 border-l-0 rotate-45"></div>

            </div>

            <!-- TITLE -->
            <h1 class="text-center text-[42px] font-bold text-gray-900 dark:text-white mb-3 leading-tight sm:text-[34px]">
                Sign in to Dribbble
            </h1>

            <!-- SUBTITLE -->
            <p class="text-center text-gray-500 dark:text-slate-300 text-[16px] leading-7 mb-[30px] sm:text-[15px]">
                Welcome back! Enter your credentials to access your account.
            </p>

            @if(session('error'))
                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-2xl border border-red-200 text-center">
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- FORM -->
            <form method="POST" action="{{ route('login.proses') }}">
                @csrf

                <!-- EMAIL -->
                <div class="mb-4">
                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full px-[18px] py-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-[#0f172a] text-sm text-gray-900 dark:text-white transition duration-300 focus:outline-none focus:border-[#d89ae4] focus:bg-white dark:focus:bg-[#111827] focus:ring-4 focus:ring-[#d89ae4]/15"
                    >
                </div>

                <!-- PASSWORD -->
                <div class="mb-4">
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="w-full px-[18px] py-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-[#0f172a] text-sm text-gray-900 dark:text-white transition duration-300 focus:outline-none focus:border-[#d89ae4] focus:bg-white dark:focus:bg-[#111827] focus:ring-4 focus:ring-[#d89ae4]/15"
                    >
                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full py-4 rounded-full bg-gray-900 dark:bg-white text-white dark:text-black text-[15px] font-semibold mt-2 transition duration-300 hover:bg-black hover:-translate-y-[2px]"
                >
                    Sign In
                </button>
            </form>

            <!-- BOTTOM TEXT -->
            <div class="text-center mt-6 text-gray-500 dark:text-slate-300 text-[13px] leading-7">
                Don't have an account?

                <a
                    href="{{ route('register') }}"
                    class="text-gray-900 dark:text-white no-underline font-semibold"
                >
                    Sign up
                </a>
            </div>

        </div>
    </div>

    <!-- RIGHT -->
    <div class="w-full lg:w-[35%] h-[300px] lg:h-auto relative overflow-hidden bg-slate-900">

        <img
            src="https://images.unsplash.com/photo-1511300636408-a63a89df3482?q=80&w=1200&auto=format&fit=crop"
            class="bg-image absolute w-full h-full object-cover"
            alt="Design Inspiration"
        >

        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/20 to-slate-900/45"></div>

        <div class="circle absolute w-[90px] h-[90px] top-[15%] left-[10%] rounded-full bg-white/10 backdrop-blur-md"></div>

        <div class="circle circle2 absolute w-[130px] h-[130px] bottom-[15%] right-[10%] rounded-full bg-white/10 backdrop-blur-md"></div>

        <div class="circle circle3 absolute w-[70px] h-[70px] top-[55%] left-[30%] rounded-full bg-white/10 backdrop-blur-md"></div>

    </div>

</div>

<script>
    if (
        localStorage.theme === 'dark' ||
        (
            !('theme' in localStorage) &&
            window.matchMedia('(prefers-color-scheme: dark)').matches
        )
    ) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>

</body>
</html>