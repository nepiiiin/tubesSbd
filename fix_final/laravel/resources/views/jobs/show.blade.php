@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-12">

    <!-- Back Button -->
    <a href="{{ route('jobs.index') }}"
       class="inline-flex items-center text-gray-500 hover:text-gray-900 mb-10 text-sm font-medium transition">
        ← Back to Jobs
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_360px] gap-16">

        <!-- LEFT CONTENT -->
        <div>

            <!-- HEADER -->
            <div class="mb-12">

                <span class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                    Job Details
                </span>

                <h1 class="text-6xl font-bold text-[#0d0c22] mt-4 mb-5 leading-tight">
                    {{ $job->title }}
                </h1>

                <!-- META -->
                <div class="flex flex-wrap items-center gap-5 text-gray-500 text-lg">

                    <span>
                        {{ $job->company_name }}
                    </span>

                    <span>
                        📍 {{ $job->location ?? 'Remote' }}
                    </span>

                    <span>
                        📅 Posted {{ $job->created_at->format('F d, Y') }}
                    </span>

                </div>

            </div>

            <!-- DESCRIPTION -->
            <div class="prose prose-lg max-w-none prose-headings:text-[#0d0c22] prose-p:text-gray-700 prose-strong:text-[#0d0c22]">

                {!! $job->description_html !!}

            </div>

            <!-- BOTTOM APPLY BUTTON -->
            <div class="mt-14">

                <a
                    href="{{ $job->apply_url ?? '#' }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center justify-center px-10 h-14 rounded-full bg-[#0d0c22] hover:bg-pink-500 text-white text-lg font-semibold transition"
                >
                    Apply for this position
                </a>

            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div>

            <div class="sticky top-10 border-l border-gray-200 pl-10">

                <!-- COMPANY -->
                <div class="text-center">

                    <!-- LOGO -->
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl overflow-hidden bg-white border border-gray-100 flex items-center justify-center p-2">

                        @if($job->company_logo)

                            <img
                                src="{{ $job->company_logo }}"
                                alt="{{ $job->company_name }}"
                                class="max-w-full max-h-full object-contain"
                            >

                        @endif

                    </div>

                    <!-- COMPANY NAME -->
                    <h2 class="text-4xl font-bold text-[#0d0c22] leading-tight mb-5">

                        {{ $job->company_name }}

                    </h2>

                    <!-- WEBSITE SECTION -->
               <!-- WEBSITE -->
@if($job->website)
    <a
        href="{{ $job->website }}"
        target="_blank"
        rel="noopener noreferrer"
        class="text-lg text-gray-700 hover:text-pink-500 transition"
    >
        Visit Website
    </a>
@endif

<!-- APPLY -->
<div class="mt-8 mb-12 flex justify-center">

    <a
        href="{{ $job->apply_url }}"
        target="_blank"
        rel="noopener noreferrer"
        class="w-full flex items-center justify-center h-14 rounded-full bg-[#0d0c22] hover:bg-pink-500 text-white font-semibold text-lg transition"
    >
        Apply for this position
    </a>

</div>

</div>

                <hr class="my-10 border-gray-200">

                <!-- JOB TYPE -->
                <div class="mb-10">

                    <h3 class="text-gray-500 text-sm mb-3 uppercase tracking-wider">
                        Job Type
                    </h3>

                    <p class="text-2xl font-bold text-[#0d0c22]">
                        {{ $job->job_type ? ucwords(str_replace('-', ' ', $job->job_type)) : 'Full Time' }}
                    </p>

                </div>

                <!-- LOCATION -->
                <div class="mb-10">

                    <h3 class="text-gray-500 text-sm mb-3 uppercase tracking-wider">
                        Location
                    </h3>

                    <p class="text-2xl font-semibold text-[#0d0c22] leading-relaxed">
                        {{ $job->location ?? 'Remote' }}
                    </p>

                    <p class="text-lg text-gray-600 mt-2">
                        Remote Friendly
                    </p>

                </div>

                <!-- Employer Actions -->
                @auth
                    @if(Auth::id() === $job->poster_id || Auth::user()->role === 'admin')

                    <hr class="my-10 border-gray-200">

                    <div>

                        <h4 class="font-semibold text-gray-900 mb-5 text-lg">
                            Employer Actions
                        </h4>

                        <div class="flex flex-col gap-3">

                            <a href="{{ route('jobs.edit', $job) }}"
                               class="w-full h-12 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-medium flex items-center justify-center transition">
                                Edit Job
                            </a>

                            <a href="{{ route('jobs.applications', $job) }}"
                               class="w-full h-12 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white font-medium flex items-center justify-center transition">
                                View {{ $job->applications_count }} Applications
                            </a>

                            <form action="{{ route('jobs.destroy', $job) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this job?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="w-full h-12 rounded-xl bg-red-500 hover:bg-red-600 text-white font-medium transition">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                    @endif
                @endauth

            </div>

        </div>

    </div>

</div>
@endsection