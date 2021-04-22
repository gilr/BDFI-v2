<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorPolicy
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
     * @param  \App\Models\Author  $author
     * @return mixed
     */
    public function view(User $user, Author $author)
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
     * @param  \App\Models\Author  $author
     * @return mixed
     */
    public function update(User $user, Author $author)
    {
        return $user->hasEditorRole();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Author  $author
     * @return mixed
     */
    public function delete(User $user, Author $author)
    {
        return $user->hasEditorRole();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Author  $author
     * @return mixed
     */
    public function restore(User $user, Author $author)
    {
        return $user->hasAdminRole() || $user->id === $author->destructor;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Author  $author
     * @return mixed
     */
    public function forceDelete(User $user, Author $author)
    {
        return $user->hasSysAdminRole();
    }


    public function addWebsite(User $user, Author $author)
    {
        return $user->hasEditorRole();
    }
    public function attachAnyAuthor(User $user, Author $author)
    {
        return $user->hasEditorRole();
    }
    public function attachAuthor(User $user, Author $author, Author $author2)
    {
        return $user->hasEditorRole() && ! $author->signatures->contains($author2) && ! $author->references->contains($author2);
        //return false;
    }
    public function detachAuthor(User $user, Author $author, Author $author2)
    {
        return $user->hasEditorRole();
    }
}
