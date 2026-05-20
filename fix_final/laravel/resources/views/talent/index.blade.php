@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold text-gray-900 mb-4">
            Hire Top Designers
        </h1>

        <p class="text-gray-500 text-lg">
            Connect with talented designers from around the world.
        </p>
    </div>

    @if($designers->isEmpty())

        <div class="bg-white border border-gray-200 rounded-2xl p-12 text-center">
            <p class="text-gray-500 text-lg">
                No designers found.
            </p>
        </div>

    @else

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($designers as $designer)

        <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition">

            <div class="flex items-center gap-4 mb-5">

                <img
                    src="{{ $designer->avatar_url }}"
                    alt="{{ $designer->username }}"
                    class="w-16 h-16 rounded-full object-cover border"
                >

                <div>
                    <h2 class="font-bold text-lg text-gray-900">
                        {{ $designer->full_name }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ '@'.$designer->username }}
                    </p>
                </div>

            </div>

            <p class="text-gray-600 text-sm mb-5 line-clamp-3">
                {{ $designer->bio ?? 'No bio yet.' }}
            </p>

            <div class="flex items-center justify-between text-sm text-gray-500 mb-5">

                <span>
                    📍 {{ $designer->location ?? 'Remote' }}
                </span>

                <span>
                    {{ $designer->shots_count }} shots
                </span>

            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route('user.profile', $designer->username) }}"
                    class="flex-1 bg-gray-900 hover:bg-black text-white text-center py-2 rounded-lg text-sm"
                >
                    View Profile
                </a>

                <a
                    href="mailto:{{ $designer->email }}"
                    class="flex-1 bg-pink-500 hover:bg-pink-600 text-white text-center py-2 rounded-lg text-sm"
                >
                    Get in Touch
                </a>

            </div>

        </div>

        @endforeach

    </div>

    <div class="mt-10">
        {{ $designers->links() }}
    </div>

    @endif

</div>
@endsection