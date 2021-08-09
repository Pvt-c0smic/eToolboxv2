<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ComplianceAction;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComplianceActionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the complianceAction can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list complianceactions');
    }

    /**
     * Determine whether the complianceAction can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplianceAction  $model
     * @return mixed
     */
    public function view(User $user, ComplianceAction $model)
    {
        return $user->hasPermissionTo('view complianceactions');
    }

    /**
     * Determine whether the complianceAction can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create complianceactions');
    }

    /**
     * Determine whether the complianceAction can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplianceAction  $model
     * @return mixed
     */
    public function update(User $user, ComplianceAction $model)
    {
        return $user->hasPermissionTo('update complianceactions');
    }

    /**
     * Determine whether the complianceAction can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplianceAction  $model
     * @return mixed
     */
    public function delete(User $user, ComplianceAction $model)
    {
        return $user->hasPermissionTo('delete complianceactions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplianceAction  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete complianceactions');
    }

    /**
     * Determine whether the complianceAction can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplianceAction  $model
     * @return mixed
     */
    public function restore(User $user, ComplianceAction $model)
    {
        return false;
    }

    /**
     * Determine whether the complianceAction can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplianceAction  $model
     * @return mixed
     */
    public function forceDelete(User $user, ComplianceAction $model)
    {
        return false;
    }
}
