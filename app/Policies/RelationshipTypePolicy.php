<?php

namespace App\Policies;

use App\Models\RelationshipType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RelationshipTypePolicy
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
     * @param  \App\Models\RelationshipType  $relationshipType
     * @return mixed
     */
    public function view(User $user, RelationshipType $relationshipType)
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
     * @param  \App\Models\RelationshipType  $relationshipType
     * @return mixed
     */
    public function update(User $user, RelationshipType $relationshipType)
    {
        return $user->hasAdminRole();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RelationshipType  $relationshipType
     * @return mixed
     */
    public function delete(User $user, RelationshipType $relationshipType)
    {
        return $user->hasAdminRole();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RelationshipType  $relationshipType
     * @return mixed
     */
    public function restore(User $user, RelationshipType $relationshipType)
    {
        return $user->hasAdminRole() || $user->id === $relationshipType->destructor;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RelationshipType  $relationshipType
     * @return mixed
     */
    public function forceDelete(User $user, RelationshipType $relationshipType)
    {
        return $user->hasSysAdminRole();
    }
}
