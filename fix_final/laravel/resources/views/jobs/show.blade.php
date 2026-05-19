@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Back Button -->
    <a href="{{ route('jobs.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6 text-sm">
        ← Back to Jobs
    </a>

    <div class="bg-white rounded-xl shadow p-8 mb-6">
        <!-- Header -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $job->title }}</h1>
            <p class="text-xl text-gray-600 mb-4">{{ $job->company_name }}</p>
            <div class="flex flex-wrap gap-3">
                <span class="bg-pink-500 text-white px-4 py-1.5 rounded-full text-sm font-semibold">
                    {{ str_replace('-', ' ', $job->job_type) }}
                </span>
                <span class="text-gray-600 text-sm flex items-center gap-1">
                    📍 {{ $job->location ?? 'Remote' }}
                </span>
                <span class="text-gray-600 text-sm flex items-center gap-1">
                    📅 Posted {{ $job->created_at->format('F d, Y') }}
                </span>
            </div>
        </div>
        
        <!-- Description -->
        <div class="prose prose-gray max-w-none mb-8">
            {!! nl2br(e($job->description)) !!}
        </div>
        
        <!-- External Apply Button -->
        @if($job->apply_url)
            <a href="{{ $job->apply_url }}" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center bg-gray-900 text-white px-8 py-3 rounded-lg font-medium hover:bg-gray-800 transition">
                Apply on Company Website →
            </a>
        @endif
    </div>

    <!-- Apply Form (hanya jika login & belum apply & tidak ada external URL) -->
    @auth
        @if(!$hasApplied && !$job->apply_url)
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">📩 Apply for this Position</h3>
            
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('jobs.apply', $job) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Cover Letter <span class="text-red-500">*</span></label>
                    <textarea name="cover_letter" rows="5" required 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                              placeholder="Tell us why you're a great fit for this role...">{{ old('cover_letter') }}</textarea>
                </div>
                <div class="mb-6">
                    <label class="block font-medium text-gray-700 mb-2">Resume/CV URL</label>
                    <input type="url" name="resume_url" value="{{ old('resume_url') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-500"
                           placeholder="https://drive.google.com/your-resume">
                    <p class="text-xs text-gray-500 mt-1">Optional: Link to your portfolio, PDF resume, or LinkedIn</p>
                </div>
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-lg font-medium transition">
                    Submit Application 🚀
                </button>
            </form>
        </div>
        @elseif($hasApplied)
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-green-800 flex items-center gap-3">
                <span class="text-xl">✅</span>
                <div>
                    <p class="font-medium">You have already applied to this job.</p>
                    <p class="text-sm">Check your <a href="{{ route('applications.my') }}" class="underline hover:text-green-900">applications dashboard</a> for updates.</p>
                </div>
            </div>
        @endif
    @else
        <div class="bg-gray-100 rounded-lg p-6 text-center">
            <p class="text-gray-600 mb-4">Login to apply for this job</p>
            <a href="{{ route('login') }}" class="text-pink-500 hover:underline font-medium">Login</a>
            <span class="text-gray-400 mx-2">or</span>
            <a href="{{ route('register') }}" class="text-pink-500 hover:underline font-medium">Register</a>
        </div>
    @endauth

    <!-- Employer Actions -->
    @auth
        @if(Auth::id() === $job->poster_id || Auth::user()->role === 'admin')
        <div class="mt-8 bg-white rounded-xl shadow p-6 border border-gray-200">
            <h4 class="font-semibold text-gray-900 mb-4">⚙️ Employer Actions</h4>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('jobs.edit', $job) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    Edit Job
                </a>
                <a href="{{ route('jobs.applications', $job) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    View {{ $job->applications_count }} Applications
                </a>
                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline" onsubmit="return confirm('Delete this job?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endif
    @endauth
</div>
@endsection