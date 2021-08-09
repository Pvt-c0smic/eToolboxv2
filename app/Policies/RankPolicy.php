<?php

namespace App\Policies;

use App\Models\Rank;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RankPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the rank can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list ranks');
    }

    /**
     * Determine whether the rank can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rank  $model
     * @return mixed
     */
    public function view(User $user, Rank $model)
    {
        return $user->hasPermissionTo('view ranks');
    }

    /**
     * Determine whether the rank can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create ranks');
    }

    /**
     * Determine whether the rank can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rank  $model
     * @return mixed
     */
    public function update(User $user, Rank $model)
    {
        return $user->hasPermissionTo('update ranks');
    }

    /**
     * Determine whether the rank can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rank  $model
     * @return mixed
     */
    public function delete(User $user, Rank $model)
    {
        return $user->hasPermissionTo('delete ranks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rank  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete ranks');
    }

    /**
     * Determine whether the rank can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rank  $model
     * @return mixed
     */
    public function restore(User $user, Rank $model)
    {
        return false;
    }

    /**
     * Determine whether the rank can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rank  $model
     * @return mixed
     */
    public function forceDelete(User $user, Rank $model)
    {
        return false;
    }
}
