<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        $validated = $request->validate([
            'cover_letter' => 'required|string',
            'resume_url' => 'nullable|url',
        ]);
        
        // Cek sudah apply atau belum
        $exists = Application::where('job_id', $job->id)
            ->where('applicant_id', Auth::id())
            ->exists();
            
        if ($exists) {
            return back()->with('error', 'You have already applied to this job.');
        }
        
        // Create application dengan applied_at = now()
        $application = $job->applications()->create([
            'applicant_id' => Auth::id(),
            'cover_letter' => $validated['cover_letter'],
            'resume_url' => $validated['resume_url'],
            'status' => 'pending',
            'applied_at' => now(),
        ]);
        
        return redirect()->route('jobs.show', $job)
            ->with('success', 'Application submitted! Good luck! 🍀');
    }

    public function myApplications()
    {
        $applications = Auth::user()->applications()
            ->with('job:id,title,company_name,location,job_type')
            ->latest('applied_at')
            ->paginate(10);
            
        return view('applications.my-applications', compact('applications'));
    }

    public function jobApplications(Job $job)
    {
        // Hanya owner job atau admin yang bisa lihat
        if (Auth::id() !== $job->poster_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $applications = $job->applications()
            ->with('applicant:id,username,full_name,avatar_url,location,bio')
            ->latest('applied_at')
            ->paginate(20);
            
        return view('applications.job-applications', compact('job', 'applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        // Hanya owner job atau admin yang bisa update status
        if (Auth::id() !== $application->job->poster_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,interview,offered,rejected'
        ]);
        
        $application->update(['status' => $validated['status']]);
        
        return back()->with('success', 'Application status updated to: '.ucfirst($validated['status']));
    }
}