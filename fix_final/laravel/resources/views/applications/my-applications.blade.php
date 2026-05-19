@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <a href="{{ route('jobs.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6 text-sm">
        ← Back to Jobs
    </a>
    
    <h1 class="text-3xl font-bold text-gray-900 mb-2">My Applications</h1>
    <p class="text-gray-600 mb-8">Track the status of your job applications</p>
    
    @if($applications->isEmpty())
        <div class="bg-white rounded-xl shadow p-12 text-center">
            <p class="text-gray-500 text-lg mb-4">You haven't applied to any jobs yet.</p>
            <a href="{{ route('jobs.index') }}" class="text-pink-500 hover:underline font-medium">
                Browse Jobs →
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
            <div class="bg-white rounded-xl shadow p-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div>
                    <h3 class="font-semibold text-lg text-gray-900">
                        <a href="{{ route('jobs.show', $app->job) }}" class="hover:text-pink-500">
                            {{ $app->job->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600">{{ $app->job->company_name }} • {{ $app->job->location ?? 'Remote' }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        Applied: {{ $app->applied_at->format('M d, Y \a\t H:i') }}
                    </p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="px-4 py-1.5 rounded-full text-sm font-semibold {{ $app->status_badge_class }}">
                        {{ ucfirst($app->status) }}
                    </span>
                    @if($app->status === 'offered')
                        <span class="text-green-600 text-sm font-medium">🎉 Congratulations!</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $applications->links() }}
        </div>
    @endif
</div>
@endsection