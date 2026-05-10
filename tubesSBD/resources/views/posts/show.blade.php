<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f8f7f4] min-h-screen">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50 backdrop-blur-xl bg-white/80 border-b border-gray-200 px-8 py-4 flex justify-between items-center">

        <a href="/" class="text-2xl font-bold text-pink-500">
            Dribbble
        </a>

        <a href="/"
           class="bg-black text-white px-5 py-2 rounded-full hover:bg-gray-800 transition">
            Back
        </a>

    </nav>

    <!-- CONTENT -->
    <div class="max-w-6xl mx-auto px-6 py-10">

        <!-- TOP -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">

            <!-- TITLE -->
            <div>

                <h1 class="text-4xl font-bold text-[#0d0c22]">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-3 mt-4">

                    <!-- AVATAR -->
                    <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center text-pink-500 font-bold text-lg">

                        {{ strtoupper(substr($post->user->name ?? 'D',0,1)) }}

                    </div>

                    <!-- USER -->
                    <div>

                        <p class="font-semibold text-[#0d0c22]">
                            {{ $post->user->name ?? 'Designer' }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Available for work
                        </p>

                    </div>

                </div>

            </div>

            <!-- ACTIONS -->
            <div class="flex items-center gap-3">

                <!-- SAVE -->
                <button
                    onclick="this.classList.toggle('bg-blue-500'); this.classList.toggle('text-white');"
                    class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow hover:shadow-lg transition text-gray-700"
                >

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 5v14l7-4 7 4V5a2 2 0 00-2-2H7a2 2 0 00-2 2z"/>

                    </svg>

                </button>

                <!-- LOVE -->
                <button
                    onclick="this.classList.toggle('bg-pink-500'); this.classList.toggle('text-white');"
                    class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow hover:shadow-lg transition text-gray-700"
                >

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>

                    </svg>

                </button>

                <!-- GET IN TOUCH -->
                <button
                    onclick="document.getElementById('contactModal').classList.remove('hidden')"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-full font-semibold transition"
                >
                    Get in touch
                </button>

            </div>

        </div>

        <!-- IMAGE -->
        <div class="overflow-hidden rounded-3xl shadow-xl bg-white">

            <img
                src="https://picsum.photos/1200/700?random={{ $post->id }}"
                class="w-full object-cover"
            >

        </div>

        <!-- DESCRIPTION -->
        <div class="bg-white rounded-3xl p-8 shadow mt-8">

            <h2 class="text-2xl font-bold mb-4 text-[#0d0c22]">
                Description
            </h2>

            <p class="text-gray-600 leading-8">
                {{ $post->description }}
            </p>

        </div>

    </div>

    <!-- MODAL -->
    <div 
    id="contactModal"
    class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm overflow-y-auto"
>

        <!-- WRAPPER -->
        <div class="min-h-screen flex items-center justify-center p-4">

            <!-- BOX -->
            <div class="bg-white w-full max-w-lg rounded-3xl p-8 relative animate-modal my-10 mx-auto">
                <!-- CLOSE -->
                <button
                    onclick="document.getElementById('contactModal').classList.add('hidden')"
                    class="absolute top-5 right-5 text-gray-400 hover:text-black text-3xl z-10"
                >
                    ×
                </button>

                <!-- CONTENT -->
                <div class="p-8">

                    <!-- HEADER -->
                    <div class="flex items-start gap-4">

                        <!-- AVATAR -->
                        <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center text-pink-500 text-2xl font-bold">

                            {{ strtoupper(substr($post->user->name ?? 'D',0,1)) }}

                        </div>

                        <!-- TEXT -->
                        <div>

                            <h2 class="text-3xl font-bold text-black">
                                Connect with {{ $post->user->name ?? 'Designer' }}
                            </h2>

                            <p class="text-gray-500 mt-1">
                                Responds in about 1 hour
                            </p>

                        </div>

                    </div>

                    <!-- TABS -->
                    <div class="flex gap-3 mt-8">

                        <button class="px-5 py-2 rounded-full bg-gray-100 font-medium">
                            Message
                        </button>

                        <button class="px-5 py-2 rounded-full hover:bg-gray-100 transition">
                            Services
                        </button>

                    </div>

                    <!-- FORM -->
                    <div class="mt-8 space-y-6">

                        <!-- SWITCH -->
                        <div class="flex items-center justify-between gap-4">

                            <p class="font-medium text-gray-800">
                                I’m interested in working with {{ $post->user->name ?? 'Designer' }}
                            </p>

                            <div class="w-12 h-7 bg-pink-500 rounded-full relative flex-shrink-0">

                                <div class="w-5 h-5 bg-white rounded-full absolute top-1 right-1"></div>

                            </div>

                        </div>

                        <!-- PROJECT DETAILS -->
                        <div>

                            <div class="flex items-center gap-2 mb-2 flex-wrap">

                                <h3 class="font-semibold">
                                    Project Details
                                </h3>

                                <span class="text-sm text-gray-400">
                                    Minimum 50 characters
                                </span>

                            </div>

                            <textarea
                                rows="6"
                                placeholder="Include any project details, requirements, or goals."
                                class="w-full border border-gray-200 rounded-2xl p-4 outline-none focus:ring-2 focus:ring-pink-400 resize-none"
                            ></textarea>

                        </div>

                        <!-- TARGET DATE -->
                        <div>

                            <h3 class="font-semibold mb-2">
                                <!-- TARGET DATE -->
<div>

    <h3 class="font-semibold mb-1">
        Target Date
    </h3>

    <p class="text-gray-400 text-sm mb-3">
        Select when you need the project to be completed
    </p>

    <select
        class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-pink-400 text-gray-700 bg-white"
    >

        <option selected disabled>
            Please select...
        </option>

        <option>
            Within the next few days
        </option>

        <option>
            Within the next few weeks
        </option>

        <option>
            In a month or more
        </option>

        <option>
            Not sure
        </option>

    </select>

</div>
                        <!-- BUDGET -->
                        <div>

                            <h3 class="font-semibold mb-2">
                                Project Budget
                            </h3>

                            <div class="flex items-center border border-gray-200 rounded-xl px-4 py-3">

                                <span class="text-gray-500 mr-2">$</span>

                                <input
                                    type="text"
                                    placeholder="Enter amount"
                                    class="w-full outline-none"
                                >

                            </div>

                        </div>

                        <!-- BUTTON -->
                        <button class="w-full bg-pink-500 hover:bg-pink-600 transition text-white py-4 rounded-full font-semibold text-lg">

                            Send Message

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <style>

@keyframes modalFade {
    from {
        opacity: 0;
        transform: scale(0.9) translateY(20px);
    }

    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.animate-modal {
    animation: modalFade 0.25s ease;
}

</style>

</body>
</html>