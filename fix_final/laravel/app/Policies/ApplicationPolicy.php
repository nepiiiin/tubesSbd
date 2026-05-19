<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Application;

class ApplicationPolicy
{
    public function updateStatus(User $user, Application $application): bool
    {
        return $user->id === $application->job->poster_id || $user->role === 'admin';
    }
}