@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#fafafa] text-gray-900">

    <!-- HERO -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-16">

            <div class="text-center mb-12">
                <h1 class="text-6xl font-bold tracking-tight leading-tight mb-5">
                    The #1 job board for<br>
                    graphic design jobs
                </h1>

                <p class="text-xl text-gray-500 max-w-3xl mx-auto">
                    Discover and connect with designers and jobs worldwide.
                </p>

                @if(in_array(Auth::user()->role ?? '', ['employer', 'admin']))
                    <a href="{{ route('jobs.create') }}"
                       class="inline-flex items-center gap-2 mt-8 bg-[#0d0c22] hover:bg-pink-500 text-white px-8 py-4 rounded-full font-semibold transition">
                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 4v16m8-8H4"></path>
                        </svg>

                        Post a job
                    </a>
                @endif
            </div>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex flex-col lg:flex-row gap-12">

            <!-- LEFT -->
            <div class="flex-1">
               <form method="GET" action="{{ route('jobs.index') }}">
                <!-- SEARCH -->
                <div class="mb-10">
                    <div class="relative">

                        <input
                            type="text"
                            placeholder="Search by company, skill, tag..." name="search"
                            value="{{ request('search') }}"
                            class="w-full h-[64px] rounded-2xl border border-gray-200 bg-white pl-14 pr-5 text-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                        >

                        <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                            </path>

                        </svg>

                    </div>
                </div>

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-8">

                    <h2 class="text-4xl font-bold text-[#0d0c22]">
                        Recent posts
                    </h2>

                    <span class="text-gray-500">
                        {{ $jobs->total() }} jobs found
                    </span>

                </div>

                <!-- EMPTY -->
                @if($jobs->isEmpty())

                    <div class="bg-white border border-gray-200 rounded-3xl p-16 text-center">

                        <p class="text-gray-500 text-lg">
                            No jobs found.
                        </p>

                    </div>

                @else

                    <!-- JOB LIST -->
                    <div class="space-y-5">

                        @foreach($jobs as $job)

                        <a href="{{ route('jobs.show', $job) }}"
                           class="block group">

                            <div class="bg-[#fdf7fb] border border-[#f2ddeb] rounded-3xl p-7 hover:shadow-xl transition-all duration-300">

                                <div class="flex items-center justify-between gap-6">

                                    <!-- LEFT -->
                                    <div class="flex items-center gap-5 flex-1">

                                        <!-- LOGO -->
                                        <div class="w-20 h-20 rounded-2xl overflow-hidden bg-white border border-gray-100 flex items-center justify-center flex-shrink-0">

                                            @if($job->company_logo)

                                                <img
                                                    src="{{ $job->company_logo }}"
                                                    alt="{{ $job->company_name }}"
                                                    class="w-full h-full object-contain p-2"
                                                >

                                            @else

                                                <span class="text-3xl font-bold text-gray-400">
                                                    {{ strtoupper(substr($job->company_name, 0, 1)) }}
                                                </span>

                                            @endif

                                        </div>

                                        <!-- INFO -->
                                        <div>

                                            <!-- COMPANY -->
                                            <div class="flex items-center gap-2 mb-2">

                                                <h3 class="font-semibold text-2xl text-gray-900">
                                                    {{ $job->company_name }}
                                                </h3>

                                                <div class="w-7 h-7 rounded-full bg-pink-500 flex items-center justify-center">

                                                    <svg class="w-4 h-4 text-white"
                                                         fill="currentColor"
                                                         viewBox="0 0 20 20">

                                                        <path d="M10 1l2.39 4.84L18 6.63l-4 3.9.94 5.47L10 13.77 5.06 16l.94-5.47-4-3.9 5.61-.79L10 1z"></path>

                                                    </svg>

                                                </div>

                                            </div>

                                            <!-- TITLE -->
                                            <h2 class="text-4xl font-bold text-[#0d0c22] mb-4 group-hover:text-pink-500 transition">

                                                {{ $job->title }}

                                            </h2>

                                            <!-- META -->
                                            <div class="flex items-center gap-5 text-gray-500">

                                                <div class="flex items-center gap-2">

                                                    <svg class="w-5 h-5"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">

                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                        </path>

                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>

                                                    </svg>

                                                    <span>
                                                        {{ $job->location ?? 'Remote' }}
                                                    </span>

                                                </div>

                                                <span>
                                                    {{ $job->created_at->diffForHumans() }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- RIGHT -->
                                    <div class="hidden md:flex flex-col items-end gap-4">

                                        <span class="px-5 py-2 rounded-full bg-pink-100 text-pink-500 text-xs font-bold uppercase tracking-wider">
                                            Featured
                                        </span>

                                        <span class="text-sm font-semibold text-gray-400 group-hover:text-pink-500 transition">
                                            View Job
                                        </span>

                                        <span class="text-sm text-gray-500 uppercase">
                                            {{ str_replace('-', ' ', $job->job_type) }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </a>

                        @endforeach

                    </div>

                    <!-- PAGINATION -->
                    <div class="mt-12">
                        {{ $jobs->withQueryString()->links() }}
                    </div>

                @endif

            </div>

<!-- SIDEBAR -->
<div class="lg:w-[360px]">

    <div class="bg-white border border-gray-200 rounded-3xl p-8">

            <!-- SPECIALTIES -->
            <div class="mb-8">

                <h3 class="text-3xl font-bold mb-6">
                    Specialties
                </h3>

                <div class="space-y-5">

                    @foreach([
                        'Animation',
                        'Brand / Graphic Design',
                        'Illustration',
                        'Leadership',
                        'Mobile Design',
                        'UI / Visual Design',
                        'Product Design',
                        'UX Design / Research',
                        'Web Design'
                    ] as $specialty)

                    <label class="flex items-center gap-4 cursor-pointer">

                        <input
                            type="checkbox"
                            name="specialties[]"
                            value="{{ $specialty }}"
                            class="w-6 h-6 rounded border-gray-300 text-pink-500 focus:ring-pink-500"
                        >

                        <span class="text-xl text-gray-700">
                            {{ $specialty }}
                        </span>

                    </label>

                    @endforeach

                </div>

            </div>

            <hr class="my-8">

            <!-- LOCATION -->
            <div class="mb-8">

                <h3 class="text-3xl font-bold mb-5">
                    Location
                </h3>

                <input
                    type="text"
                    name="location"
                    placeholder="Enter Location..."
                    value="{{ request('location') }}"
                    class="w-full h-14 rounded-2xl border border-gray-300 px-5 focus:outline-none focus:ring-2 focus:ring-pink-500"
                >

            </div>

            <hr class="my-8">

            <!-- JOB TYPE -->
            <div class="mb-8">

                <h3 class="text-3xl font-bold mb-5">
                    Job Type
                </h3>

                <div class="space-y-4">

                    <label class="flex items-center gap-4 cursor-pointer">

                        <input
                            type="checkbox"
                            name="job_type[]"
                            value="full-time"
                            class="w-6 h-6 rounded border-gray-300 text-pink-500 focus:ring-pink-500"
                        >

                        <span class="text-xl text-gray-700">
                            Full-Time
                        </span>

                    </label>

                    <label class="flex items-center gap-4 cursor-pointer">

                        <input
                            type="checkbox"
                            name="job_type[]"
                            value="freelance"
                            class="w-6 h-6 rounded border-gray-300 text-pink-500 focus:ring-pink-500"
                        >

                        <span class="text-xl text-gray-700">
                            Freelance / Contract
                        </span>

                    </label>

                </div>

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full h-14 rounded-full bg-[#0d0c22] hover:bg-pink-500 text-white font-semibold text-lg transition"
            >
                Filter
            </button>

        </form>

    </div>

</div>
        </div>

    </div>
</div>
</div>
@endsection