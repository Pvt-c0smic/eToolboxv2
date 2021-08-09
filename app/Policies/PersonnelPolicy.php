<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Personnel;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonnelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the personnel can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allpersonnel');
    }

    /**
     * Determine whether the personnel can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Personnel  $model
     * @return mixed
     */
    public function view(User $user, Personnel $model)
    {
        return $user->hasPermissionTo('view allpersonnel');
    }

    /**
     * Determine whether the personnel can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allpersonnel');
    }

    /**
     * Determine whether the personnel can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Personnel  $model
     * @return mixed
     */
    public function update(User $user, Personnel $model)
    {
        return $user->hasPermissionTo('update allpersonnel');
    }

    /**
     * Determine whether the personnel can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Personnel  $model
     * @return mixed
     */
    public function delete(User $user, Personnel $model)
    {
        return $user->hasPermissionTo('delete allpersonnel');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Personnel  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allpersonnel');
    }

    /**
     * Determine whether the personnel can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Personnel  $model
     * @return mixed
     */
    public function restore(User $user, Personnel $model)
    {
        return false;
    }

    /**
     * Determine whether the personnel can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Personnel  $model
     * @return mixed
     */
    public function forceDelete(User $user, Personnel $model)
    {
        return false;
    }
}
