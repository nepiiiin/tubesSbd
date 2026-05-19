<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('poster:id,username');
        
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }
        
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }
        
        $jobs = $query->latest()->paginate(12);
        
        return view('jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $job->load('poster:id,username,email,avatar_url');
        
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = $job->applications()
                ->where('applicant_id', Auth::id())
                ->exists();
        }
        
        return view('jobs.show', compact('job', 'hasApplied'));
    }

    public function create()
    {
        if (!in_array(Auth::user()->role, ['employer', 'admin'])) {
            abort(403, 'Only employers can post jobs.');
        }
        
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['employer', 'admin'])) {
            abort(403);
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'job_type' => 'required|in:full-time,part-time,freelance,contract',
            'description' => 'required|string',
            'apply_url' => 'nullable|url',
        ]);
        
        $job = Auth::user()->jobs()->create($validated);
        
        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job posted successfully! 🎉');
    }

    public function edit(Job $job)
    {
        if (Auth::id() !== $job->poster_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        if (Auth::id() !== $job->poster_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'job_type' => 'required|in:full-time,part-time,freelance,contract',
            'description' => 'required|string',
            'apply_url' => 'nullable|url',
        ]);
        
        $job->update($validated);
        
        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        if (Auth::id() !== $job->poster_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $job->delete();
        
        return redirect()->route('jobs.index')
            ->with('success', 'Job deleted successfully!');
    }
}