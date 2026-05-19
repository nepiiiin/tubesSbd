<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Job;

class JobPolicy
{
    public function create(User $user): bool
    {
        return in_array($user->role, ['employer', 'admin']);
    }

    public function update(User $user, Job $job): bool
    {
        return $user->id === $job->poster_id || $user->role === 'admin';
    }

    public function delete(User $user, Job $job): bool
    {
        return $user->id === $job->poster_id || $user->role === 'admin';
    }

    public function viewApplications(User $user, Job $job): bool
    {
        return $user->id === $job->poster_id || $user->role === 'admin';
    }
}