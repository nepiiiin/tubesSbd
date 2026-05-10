@extends('layouts.app')

@section('content')

<div class="mb-10">

    <h1 class="text-5xl font-bold leading-tight">
        Discover the world’s top designers
    </h1>

    <p class="text-gray-500 mt-4 text-lg">
        Explore work from talented designers around the world.
    </p>

</div>

<div class="grid grid-cols-4 gap-6">

    @foreach ($posts as $post)

    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300">

        <img
            src="{{ $post->image }}"
            class="w-full h-60 object-cover"
        >

        <div class="p-4">

            <div class="flex justify-between items-center">

                <div>

                    <h2 class="font-semibold">
                        {{ $post->title }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $post->user->username }}
                    </p>

                </div>

                <div class="text-sm text-gray-400">
                    Likes {{ $post->likes->count() }}
                </div>

            </div>

        </div>

    </div>

    @endforeach

</div>

@endsection