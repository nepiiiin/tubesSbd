<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Shot</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-white">
    <form action="{{ route('shots.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    @if ($errors->any())
        <div class="max-w-4xl mx-auto mt-6 rounded-2xl bg-red-50 border border-red-200 text-red-600 p-5">
            <p class="font-bold mb-2">Upload gagal:</p>

            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="min-h-screen bg-white">
        {{-- Top Bar --}}
        <div class="flex items-center justify-between px-8 py-6 border-b border-gray-200">

            <a href="/profile/{{ auth()->user()->username }}"
                class="px-6 py-3 border border-gray-300 rounded-full font-medium hover:bg-gray-50 transition">
                Cancel
            </a>

            <div class="flex items-center gap-4">
                <button type="submit"
                    class="px-6 py-3 bg-black text-white rounded-full font-medium hover:opacity-90 transition">
                    Continue
                </button>

            </div>

        </div>


        {{-- Content --}}
        <div class="max-w-6xl mx-auto px-6 py-14">

            {{-- Title --}}
            <div class="text-center">

                <h1 class="text-5xl font-bold text-gray-900">
                    What have you been working on?
                </h1>

                <p class="mt-4 text-lg text-gray-500">
                    Add images, video, or GIFs to showcase your work
                </p>

            </div>


           {{-- Upload Box --}}
<div
    class="mt-14 border-2 border-dashed border-gray-300 rounded-3xl min-h-[500px]
           flex flex-col items-center justify-center text-center p-10 relative overflow-hidden">

    {{-- Preview Image --}}
    <img id="preview-image"
        class="hidden max-h-[450px] rounded-2xl object-contain">

    {{-- Upload Content --}}
    <div id="upload-content">

        <div
            class="w-24 h-24 rounded-3xl bg-pink-100 flex items-center justify-center text-5xl mx-auto">
            🖼️
        </div>

        <p class="mt-8 text-3xl font-semibold text-gray-800">
            Drag and drop an image, or

            <label for="file-upload"
                class="text-pink-500 cursor-pointer hover:underline">
                Browse
            </label>
        </p>

        <p class="mt-4 text-gray-500">
            Minimum 1600px width recommended.
        </p>

        <p class="text-gray-500">
            Max 10MB each (20MB for videos)
        </p>

    </div>

    {{-- File Input --}}
   <input
    id="file-upload"
    name="image"
    type="file"
    accept="image/*"
    class="hidden"
    required>

</div>



            {{-- Form --}}
            <div class="mt-14 max-w-4xl mx-auto space-y-8">

                {{-- Title --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-900 mb-3">
                        Title
                    </label>

                    <input type="text"
                        name="title"
                        placeholder="Give your shot a short, descriptive title"
                    required
                    class="w-full border border-gray-300 rounded-2xl px-5 py-4
                    focus:outline-none focus:ring-2 focus:ring-pink-400">

                </div>


                {{-- Description --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-900 mb-3">
                        Description
                    </label>

                    <textarea rows="5"
                        name="description"
                        placeholder="Describe your work..."
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4
                   focus:outline-none focus:ring-2 focus:ring-pink-400"></textarea>

                </div>


                {{-- Category --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-900 mb-3">
                        Category
                    </label>

                    <select
                        name="category"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4
                   focus:outline-none focus:ring-2 focus:ring-pink-400">

                        <option disabled selected>Select category</option>

                        <option value="discover">discover</option>
                        <option value="animation">animation</option>
                        <option value="branding">branding</option>
                        <option value="illustration">illustration</option>
                        <option value="mobile">mobile</option>
                        <option value="print">print</option>
                        <option value="product-design">product-design</option>
                        <option value="typography">typography</option>

                    </select>

                </div>

            </div>

        </div>

    </div>
</form>
<script>
    const fileInput = document.getElementById('file-upload');
    const previewImage = document.getElementById('preview-image');
    const uploadContent = document.getElementById('upload-content');

    fileInput.addEventListener('change', function() {

        const file = this.files[0];

        if (file) {

            const reader = new FileReader();

            reader.onload = function(e) {

                previewImage.src = e.target.result;

                previewImage.classList.remove('hidden');

                uploadContent.classList.add('hidden');
            }

            reader.readAsDataURL(file);
        }

    });
</script>
</body>

</html>