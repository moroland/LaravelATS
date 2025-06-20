<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\Position;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobApplication $jobApplication): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        if ($jobApplication->applicant_user_id === $user->id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobApplication $jobApplication): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobApplication $jobApplication): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JobApplication $jobApplication): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JobApplication $jobApplication): bool
    {
        return false;
    }

}
