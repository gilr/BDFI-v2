<?php

namespace App\Policies;

use App\Models\Award;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AwardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasVisitorRole();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Award  $award
     * @return mixed
     */
    public function view(User $user, Award $award)
    {
        return $user->hasVisitorRole();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasEditorRole();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Award  $award
     * @return mixed
     */
    public function update(User $user, Award $award)
    {
        return $user->hasEditorRole();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Award  $award
     * @return mixed
     */
    public function delete(User $user, Award $award)
    {
        return $user->hasAdminRole();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Award  $award
     * @return mixed
     */
    public function restore(User $user, Award $award)
    {
        return $user->hasAdminRole();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Award  $award
     * @return mixed
     */
    public function forceDelete(User $user, Award $award)
    {
        return $user->hasSysAdminRole();
    }
}
