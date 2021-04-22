<?php

namespace App\Policies;

use App\Models\Signature;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SignaturePolicy
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
     * @param  \App\Models\Signature  $signature
     * @return mixed
     */
    public function view(User $user, Signature $signature)
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
     * @param  \App\Models\Signature  $signature
     * @return mixed
     */
    public function update(User $user, Signature $signature)
    {
        return $user->hasEditorRole();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Signature  $signature
     * @return mixed
     */
    public function delete(User $user, Signature $signature)
    {
        return $user->hasEditorRole();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Signature  $signature
     * @return mixed
     */
    public function restore(User $user, Signature $signature)
    {
        return $user->hasAdminRole() || $user->id === $signature->destructor;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Signature  $signature
     * @return mixed
     */
    public function forceDelete(User $user, Signature $signature)
    {
        return $user->hasSysAdminRole();
    }
}
