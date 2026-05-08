<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Shot - Dribbble Clone</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dribbble: {
                            pink: '#ea4c89',
                            dark: '#0d0c22',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#f8f7f4] min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center sticky top-0 z-50">

        <div class="flex items-center space-x-8">

            <a href="/" class="text-2xl font-bold text-[#ea4c89]">
                Dribbble
            </a>

            <div class="hidden md:flex space-x-6 text-sm font-medium text-gray-700">
                <a href="#" class="hover:text-[#ea4c89] transition">Explore</a>
                <a href="#" class="hover:text-[#ea4c89] transition">Hire Talent</a>
                <a href="#" class="hover:text-[#ea4c89] transition">Inspiration</a>
            </div>

        </div>

        <a href="/"
           class="bg-black text-white px-5 py-2 rounded-full hover:bg-gray-800 transition">
            Back
        </a>

    </nav>

    <!-- CONTENT -->
    <div class="max-w-3xl mx-auto py-12 px-6">

        <!-- TITLE -->
        <div class="mb-10">
            <h1 class="text-5xl font-bold text-[#0d0c22] mb-3">
                Upload your shot
            </h1>

            <p class="text-gray-500 text-lg">
                Share your latest design with the world.
            </p>
        </div>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-600 px-4 py-3 rounded-2xl mb-6">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM CARD -->
        <div class="bg-white rounded-[32px] shadow-sm p-8 border border-gray-100">

            <form action="/posts" method="POST" class="space-y-7">

                @csrf

                <!-- IMAGE -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Image URL
                    </label>

                    <input type="text"
                           name="image"
                           value="{{ old('image') }}"
                           placeholder="https://example.com/image.jpg"
                           class="w-full border border-gray-300 rounded-2xl p-4 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">

                    <p class="text-sm text-gray-400 mt-2">
                        Paste an image URL from Unsplash, Picsum, etc.
                    </p>
                </div>

                <!-- TITLE -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Title
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Amazing dashboard design..."
                           class="w-full border border-gray-300 rounded-2xl p-4 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
                </div>

                <!-- DESCRIPTION -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Description
                    </label>

                    <textarea name="description"
                              rows="6"
                              placeholder="Tell us about your design..."
                              class="w-full border border-gray-300 rounded-2xl p-4 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">{{ old('description') }}</textarea>
                </div>

                <!-- BUTTON -->
                <div class="pt-4 flex items-center justify-end space-x-4">

                    <a href="/"
                       class="px-6 py-3 rounded-full border border-gray-300 hover:bg-gray-100 transition font-medium">
                        Cancel
                    </a>

                    <button type="submit"
                            class="bg-[#ea4c89] hover:scale-[1.02] hover:opacity-90 text-white px-8 py-3 rounded-full font-semibold transition duration-200 shadow-md">
                        Publish Shot
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>