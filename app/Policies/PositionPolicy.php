<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\Position;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PositionPolicy
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
    public function view(User $user, Position $position): bool
    {
        return true;
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
    public function update(User $user, Position $position): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Position $position): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Position $position): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Position $position): bool
    {
        return false;
    }

    public function apply(User $user, Position $position): Response {
        // Deny if missing profile details.
        if (!$user->avatar || trim($user->about) == '' || trim($user->phone) == '') {
            return Response::deny('Please complete your profile details before applying.');
        }

        // Deny if already applied.
        $job_applications = JobApplication::where([
            [
                'position_id',
                '=',
                $position->id
            ],
            ['applicant_user_id', '=', $user->id]
        ])->get();

        if ($job_applications->count() > 0) {
            return Response::deny('Already applied for this position.');
        }

        // Deny if over the limit.
        $job_applications = JobApplication::where([
            [
                'position_id',
                '=',
                $position->id
            ]
        ])->get();

        if ($job_applications->count() > $position->max_applicants) {
            return Response::deny('Position is full.');
        }

        // Deny if position is closed;
        if ($position->status !== 'open') {
            return Response::deny('Position is closed.');
        }

        return Response::allow();
    }
}
