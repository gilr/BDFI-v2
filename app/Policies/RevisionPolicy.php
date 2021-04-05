<?php

namespace App\Policies;

use \Venturecraft\Revisionable\Revision;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RevisionPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Revision  $revision
     * @return mixed
     */
    public function view(User $user, Revision $revision)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Revision  $revision
     * @return mixed
     */
    public function update(User $user, Revision $revision)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Revision  $revision
     * @return mixed
     */
    public function delete(User $user, Revision $revision)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Revision  $revision
     * @return mixed
     */
    public function restore(User $user, Revision $revision)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Revision  $revision
     * @return mixed
     */
    public function forceDelete(User $user, Revision $revision)
    {
        return false;
    }
}
