<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PersonnelType;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonnelTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the personnelType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list personneltypes');
    }

    /**
     * Determine whether the personnelType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PersonnelType  $model
     * @return mixed
     */
    public function view(User $user, PersonnelType $model)
    {
        return $user->hasPermissionTo('view personneltypes');
    }

    /**
     * Determine whether the personnelType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create personneltypes');
    }

    /**
     * Determine whether the personnelType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PersonnelType  $model
     * @return mixed
     */
    public function update(User $user, PersonnelType $model)
    {
        return $user->hasPermissionTo('update personneltypes');
    }

    /**
     * Determine whether the personnelType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PersonnelType  $model
     * @return mixed
     */
    public function delete(User $user, PersonnelType $model)
    {
        return $user->hasPermissionTo('delete personneltypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PersonnelType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete personneltypes');
    }

    /**
     * Determine whether the personnelType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PersonnelType  $model
     * @return mixed
     */
    public function restore(User $user, PersonnelType $model)
    {
        return false;
    }

    /**
     * Determine whether the personnelType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PersonnelType  $model
     * @return mixed
     */
    public function forceDelete(User $user, PersonnelType $model)
    {
        return false;
    }
}
