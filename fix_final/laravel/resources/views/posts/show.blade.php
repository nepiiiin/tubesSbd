<x-app-layout>

<div class="max-w-5xl mx-auto py-10 px-6">

    <img
        src="{{ asset('storage/' . $shot->image_url) }}"
        class="w-full rounded-3xl mb-8">

    <h1 class="text-4xl font-bold mb-4">
        {{ $shot->title }}
    </h1>

    <p class="text-gray-600 text-lg">
        {{ $shot->description }}
    </p>

</div>

</x-app-layout>