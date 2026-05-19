@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <!-- Back Button -->
    <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6 text-sm">
        ← Back to Job
    </a>
    
    <h1 class="text-3xl font-bold text-[#0d0c22] mb-2">Edit Job</h1>
    <p class="text-gray-600 mb-8">Update your job posting details</p>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jobs.update', $job) }}" method="POST" class="bg-white rounded-xl shadow p-8">
        @csrf
        @method('PUT')  <!-- ✅ PENTING: Method spoofing untuk UPDATE -->
        
        <!-- Job Title -->
        <div class="mb-6">
            <label class="block font-medium text-[#0d0c22] mb-2">Job Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" required 
                   value="{{ old('title', $job->title) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#ea4c89] focus:border-[#ea4c89] transition"
                   placeholder="e.g., Senior UI/UX Designer">
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        
        <!-- Company Name -->
        <div class="mb-6">
            <label class="block font-medium text-[#0d0c22] mb-2">Company Name <span class="text-red-500">*</span></label>
            <input type="text" name="company_name" required 
                   value="{{ old('company_name', $job->company_name) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5"
                   placeholder="Your company name">
            @error('company_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        
        <!-- Job Type & Location (Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-medium text-[#0d0c22] mb-2">Job Type <span class="text-red-500">*</span></label>
                <select name="job_type" required 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#ea4c89]">
                    <option value="">Select...</option>
                    <option value="full-time" {{ old('job_type', $job->job_type)=='full-time'?'selected':'' }}>Full Time</option>
                    <option value="part-time" {{ old('job_type', $job->job_type)=='part-time'?'selected':'' }}>Part Time</option>
                    <option value="freelance" {{ old('job_type', $job->job_type)=='freelance'?'selected':'' }}>Freelance</option>
                    <option value="contract" {{ old('job_type', $job->job_type)=='contract'?'selected':'' }}>Contract</option>
                </select>
                @error('job_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-medium text-[#0d0c22] mb-2">Location</label>
                <input type="text" name="location" 
                       value="{{ old('location', $job->location) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5" 
                       placeholder="Remote, Jakarta, New York, etc.">
                @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        
        <!-- Description -->
        <div class="mb-6">
            <label class="block font-medium text-[#0d0c22] mb-2">Description <span class="text-red-500">*</span></label>
            <textarea name="description" required rows="8" 
                      class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#ea4c89]">{{ old('description', $job->description) }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Describe the role, requirements, benefits, and how to apply</p>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        
        <!-- Application URL -->
        <div class="mb-8">
            <label class="block font-medium text-[#0d0c22] mb-2">Application URL (Optional)</label>
            <input type="url" name="apply_url" 
                   value="{{ old('apply_url', $job->apply_url) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5" 
                   placeholder="https://your-company.com/careers/apply">
            <p class="text-xs text-gray-500 mt-1">If provided, applicants will be redirected here instead of applying on Dribbble</p>
            @error('apply_url') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4">
            <button type="submit" class="bg-[#ea4c89] hover:bg-[#c73e72] text-white px-8 py-3 rounded-lg font-medium transition">
                💾 Save Changes
            </button>
            <a href="{{ route('jobs.show', $job) }}" class="px-8 py-3 text-gray-600 hover:text-[#0d0c22] font-medium border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Cancel
            </a>
            
            <!-- Delete Button (separate, with confirmation) -->
            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="ml-auto" onsubmit="return confirm('⚠️ Are you sure you want to delete this job? This action cannot be undone.')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm">
                    🗑️ Delete Job
                </button>
            </form>
        </div>
    </form>
    
    <!-- Info Box -->
    <div class="mt-8 bg-[#f8f7f4] rounded-lg p-4 border border-gray-200">
        <p class="text-sm text-gray-600">
            <strong>💡 Tips:</strong> 
            After updating, the job will remain visible to all users. 
            Changes take effect immediately.
        </p>
    </div>
</div>
@endsection