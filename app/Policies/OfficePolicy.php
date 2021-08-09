<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Office;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfficePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the office can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list offices');
    }

    /**
     * Determine whether the office can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Office  $model
     * @return mixed
     */
    public function view(User $user, Office $model)
    {
        return $user->hasPermissionTo('view offices');
    }

    /**
     * Determine whether the office can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create offices');
    }

    /**
     * Determine whether the office can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Office  $model
     * @return mixed
     */
    public function update(User $user, Office $model)
    {
        return $user->hasPermissionTo('update offices');
    }

    /**
     * Determine whether the office can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Office  $model
     * @return mixed
     */
    public function delete(User $user, Office $model)
    {
        return $user->hasPermissionTo('delete offices');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Office  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete offices');
    }

    /**
     * Determine whether the office can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Office  $model
     * @return mixed
     */
    public function restore(User $user, Office $model)
    {
        return false;
    }

    /**
     * Determine whether the office can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Office  $model
     * @return mixed
     */
    public function forceDelete(User $user, Office $model)
    {
        return false;
    }
}
