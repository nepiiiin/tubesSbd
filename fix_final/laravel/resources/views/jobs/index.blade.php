@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">🎨 Design Jobs</h1>
            <p class="text-gray-600 mt-1">Find your next design opportunity</p>
        </div>
        @if(in_array(Auth::user()->role ?? '', ['employer', 'admin']))
            <a href="{{ route('jobs.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2.5 rounded-lg font-medium transition">
                + Post a Job
            </a>
        @endif
    </div>

    <!-- Filters -->
    <form method="GET" class="bg-white rounded-xl shadow p-4 mb-8 flex flex-wrap gap-4">
        <select name="job_type" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
            <option value="">All Types</option>
            <option value="full-time" {{ request('job_type')=='full-time'?'selected':'' }}>Full Time</option>
            <option value="part-time" {{ request('job_type')=='part-time'?'selected':'' }}>Part Time</option>
            <option value="freelance" {{ request('job_type')=='freelance'?'selected':'' }}>Freelance</option>
            <option value="contract" {{ request('job_type')=='contract'?'selected':'' }}>Contract</option>
        </select>
        <input type="text" name="location" placeholder="Location..." 
               value="{{ request('location') }}" 
               class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-pink-500">
        <button type="submit" class="bg-gray-900 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
            Filter
        </button>
        @if(request()->anyFilled(['job_type','location']))
            <a href="{{ route('jobs.index') }}" class="text-gray-500 hover:text-gray-700 text-sm underline">
                Clear
            </a>
        @endif
    </form>

    <!-- Jobs Grid -->
    @if($jobs->isEmpty())
        <div class="bg-white rounded-xl shadow p-12 text-center">
            <p class="text-gray-500 text-lg">No jobs found matching your criteria.</p>
            <a href="{{ route('jobs.index') }}" class="text-pink-500 hover:underline mt-2 inline-block">Clear filters</a>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($jobs as $job)
            <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            <a href="{{ route('jobs.show', $job) }}" class="hover:text-pink-500 transition">
                                {{ $job->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm">{{ $job->company_name }}</p>
                    </div>
                    <span class="bg-pink-100 text-pink-800 text-xs px-3 py-1 rounded-full font-semibold uppercase tracking-wide">
                        {{ str_replace('-', ' ', $job->job_type) }}
                    </span>
                </div>
                <div class="text-sm text-gray-500 mb-4 space-x-3">
                    <span>📍 {{ $job->location ?? 'Remote' }}</span>
                    <span>•</span>
                    <span>📅 {{ $job->created_at->format('M d') }}</span>
                </div>
                <p class="text-gray-700 text-sm mb-4 line-clamp-2">
                    {{ Str::limit(strip_tags($job->description), 150) }}
                </p>
                <div class="flex items-center justify-between">
                    <a href="{{ route('jobs.show', $job) }}" class="text-pink-500 hover:text-pink-600 text-sm font-medium">
                        View Details →
                    </a>
                    @if($job->applications_count > 0)
                        <span class="text-xs text-gray-400">{{ $job->applications_count }} applicants</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $jobs->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection