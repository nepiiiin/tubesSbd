@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white text-gray-900">
    
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-gray-900 mb-6">
                    The #1 job board for<br>graphic design jobs
                </h1>
                <p class="text-xl text-gray-500 max-w-3xl mx-auto mb-8">
                    Discover and connect with designers and jobs worldwide.
                </p>
                @if(in_array(Auth::user()->role ?? '', ['employer', 'admin']))
                    <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 bg-gray-900 hover:bg-pink-500 text-white px-8 py-4 rounded-full font-medium text-lg transition duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Post a job
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <div class="flex-1">
                
                <div class="mb-10">
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="Search by company, skill, tag..."
                            class="w-full pl-14 pr-4 py-5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:bg-white transition text-lg text-gray-900 placeholder-gray-400"
                        >
                        <svg class="absolute left-5 top-1/2 transform -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Recent posts</h2>
                    <span class="text-sm text-gray-500">{{ $jobs->total() }} jobs found</span>
                </div>
                
                @if($jobs->isEmpty())
                    <div class="bg-white border border-gray-200 rounded-2xl p-16 text-center shadow-sm">
                        <svg class="w-20 h-20 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">No jobs found matching your criteria.</p>
                        <a href="{{ route('jobs.index') }}" class="inline-block mt-4 text-pink-500 hover:underline font-medium">Clear filters</a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($jobs as $job)
                        <div class="group bg-white border border-gray-200 rounded-xl p-6 hover:border-pink-200 hover:shadow-lg transition-all duration-300 cursor-pointer">
                            <a href="{{ route('jobs.show', $job) }}" class="block">
                                <div class="flex items-start justify-between">
                                    <div class="flex gap-5">
                                        <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-gray-400 group-hover:bg-pink-50 group-hover:text-pink-500 transition">
                                            {{ strtoupper(substr($job->company_name, 0, 1)) }}
                                        </div>
                                        
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-pink-500 transition mb-1">
                                                {{ $job->title }}
                                            </h3>
                                            <p class="text-gray-500 font-medium mb-2">{{ $job->company_name }}</p>
                                            
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400">
                                                <span class="flex items-center gap-1.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $job->location ?? 'Remote' }}
                                                </span>
                                                <span class="text-gray-300">•</span>
                                                <span>{{ $job->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden sm:block pl-6">
                                        <span class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-50 text-gray-600 text-xs font-bold uppercase tracking-wider border border-gray-100 group-hover:border-pink-200 group-hover:bg-pink-50 group-hover:text-pink-600 transition">
                                            {{ str_replace('-', ' ', $job->job_type) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $jobs->withQueryString()->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar Filter - Simple Dribbble Style -->
            <div class="lg:w-72 flex-shrink-0">
                <div class="sticky top-8">
                    <form method="GET" class="border border-gray-200 rounded-lg p-5 bg-white">
                        
                        <!-- Specialties -->
                        <div class="mb-5">
                            <h3 class="font-semibold text-gray-900 mb-3 text-sm">Specialties</h3>
                            <div class="space-y-2">
                                @foreach(['Animation', 'Brand / Graphic Design', 'Illustration', 'Leadership', 'Mobile Design', 'UI / Visual Design', 'Product Design', 'UX Design / Research', 'Web Design'] as $specialty)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 border-gray-300 rounded text-pink-500 focus:ring-pink-500">
                                    <span class="text-sm text-gray-600 hover:text-gray-900">{{ $specialty }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-5 border-gray-200">

                        <!-- Location -->
                        <div class="mb-5">
                            <h3 class="font-semibold text-gray-900 mb-3 text-sm">Location</h3>
                            <input 
                                type="text" 
                                name="location" 
                                placeholder="Enter Location..."
                                value="{{ request('location') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                            >
                            <label class="flex items-center gap-2 mt-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 border-gray-300 rounded text-pink-500 focus:ring-pink-500">
                                <span class="text-sm text-gray-600 hover:text-gray-900">Open to remote</span>
                            </label>
                        </div>

                        <hr class="my-5 border-gray-200">

                        <!-- Job Type -->
                        <div class="mb-5">
                            <h3 class="font-semibold text-gray-900 mb-3 text-sm">Job Type</h3>
                            <label class="flex items-center gap-2 cursor-pointer mb-2">
                                <input 
                                    type="checkbox" 
                                    name="job_type" 
                                    value="full-time"
                                    {{ request('job_type')=='full-time'?'checked':'' }}
                                    class="w-4 h-4 border-gray-300 rounded text-pink-500 focus:ring-pink-500"
                                >
                                <span class="text-sm text-gray-600 hover:text-gray-900">Full-Time</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    name="job_type" 
                                    value="freelance"
                                    {{ request('job_type')=='freelance'?'checked':'' }}
                                    class="w-4 h-4 border-gray-300 rounded text-pink-500 focus:ring-pink-500"
                                >
                                <span class="text-sm text-gray-600 hover:text-gray-900">Freelance/Contract</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-gray-400 text-white py-2.5 rounded-full text-sm font-medium hover:bg-gray-500 transition">
                            Filter
                        </button>

                        @if(request()->anyFilled(['job_type','location']))
                            <a href="{{ route('jobs.index') }}" class="block text-center text-pink-500 hover:underline mt-3 text-xs">
                                Clear filters
                            </a>
                        @endif
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection