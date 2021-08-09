<?php

namespace App\Policies;

use App\Models\Bos;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BosPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bos can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allbos');
    }

    /**
     * Determine whether the bos can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bos  $model
     * @return mixed
     */
    public function view(User $user, Bos $model)
    {
        return $user->hasPermissionTo('view allbos');
    }

    /**
     * Determine whether the bos can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allbos');
    }

    /**
     * Determine whether the bos can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bos  $model
     * @return mixed
     */
    public function update(User $user, Bos $model)
    {
        return $user->hasPermissionTo('update allbos');
    }

    /**
     * Determine whether the bos can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bos  $model
     * @return mixed
     */
    public function delete(User $user, Bos $model)
    {
        return $user->hasPermissionTo('delete allbos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bos  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allbos');
    }

    /**
     * Determine whether the bos can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bos  $model
     * @return mixed
     */
    public function restore(User $user, Bos $model)
    {
        return false;
    }

    /**
     * Determine whether the bos can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bos  $model
     * @return mixed
     */
    public function forceDelete(User $user, Bos $model)
    {
        return false;
    }
}
