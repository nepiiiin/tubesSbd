@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-2 text-sm">
                ← Back to Job
            </a>
            <h1 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h1>
            <p class="text-gray-600">{{ $applications->total() }} Applications</p>
        </div>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-xl shadow p-12 text-center">
            <p class="text-gray-500 text-lg">No applications yet.</p>
        </div>
    @else
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Applicant</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Applied</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($applications as $app)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($app->applicant->avatar_url)
                                    <img src="{{ $app->applicant->avatar_url }}" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-semibold">
                                        {{ strtoupper(substr($app->applicant->username, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ $app->applicant->full_name ?? $app->applicant->username }}</p>
                                    @if($app->applicant->location)
                                        <p class="text-sm text-gray-500">📍 {{ $app->applicant->location }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $app->applied_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('applications.update-status', $app) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                        class="text-sm px-3 py-1.5 rounded-full font-semibold border-0 cursor-pointer {{ $app->status_badge_class }}">
                                    <option value="pending" {{ $app->status=='pending'?'selected':'' }}>Pending</option>
                                    <option value="reviewed" {{ $app->status=='reviewed'?'selected':'' }}>Reviewed</option>
                                    <option value="interview" {{ $app->status=='interview'?'selected':'' }}>Interview</option>
                                    <option value="offered" {{ $app->status=='offered'?'selected':'' }}>Offered</option>
                                    <option value="rejected" {{ $app->status=='rejected'?'selected':'' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                @if($app->applicant->bio)
                                    <button class="text-gray-400 hover:text-gray-600" title="View Bio" 
                                            onclick="alert('{{ addslashes(Str::limit($app->applicant->bio, 200)) }}')">
                                        👁
                                    </button>
                                @endif
                                @if($app->resume_url)
                                    <a href="{{ $app->resume_url }}" target="_blank" class="text-pink-500 hover:text-pink-600 text-sm font-medium">
                                        Resume →
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-8">
            {{ $applications->links() }}
        </div>
    @endif
</div>
@endsection