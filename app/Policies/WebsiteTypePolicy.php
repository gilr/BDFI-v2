<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebsiteType;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsiteTypePolicy
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
     * @param  \App\Models\WebsiteType  $websiteType
     * @return mixed
     */
    public function view(User $user, WebsiteType $websiteType)
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
        return $user->hasAdminRole();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WebsiteType  $websiteType
     * @return mixed
     */
    public function update(User $user, WebsiteType $websiteType)
    {
        return $user->hasAdminRole();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WebsiteType  $websiteType
     * @return mixed
     */
    public function delete(User $user, WebsiteType $websiteType)
    {
        return $user->hasAdminRole();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WebsiteType  $websiteType
     * @return mixed
     */
    public function restore(User $user, WebsiteType $websiteType)
    {
        return $user->hasAdminRole() || $user->id === $websiteType->destructor;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WebsiteType  $websiteType
     * @return mixed
     */
    public function forceDelete(User $user, WebsiteType $websiteType)
    {
        return $user->hasSysAdminRole();
    }
}
