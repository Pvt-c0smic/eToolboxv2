<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Compliance;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompliancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the compliance can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list compliances');
    }

    /**
     * Determine whether the compliance can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Compliance  $model
     * @return mixed
     */
    public function view(User $user, Compliance $model)
    {
        return $user->hasPermissionTo('view compliances');
    }

    /**
     * Determine whether the compliance can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create compliances');
    }

    /**
     * Determine whether the compliance can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Compliance  $model
     * @return mixed
     */
    public function update(User $user, Compliance $model)
    {
        return $user->hasPermissionTo('update compliances');
    }

    /**
     * Determine whether the compliance can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Compliance  $model
     * @return mixed
     */
    public function delete(User $user, Compliance $model)
    {
        return $user->hasPermissionTo('delete compliances');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Compliance  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete compliances');
    }

    /**
     * Determine whether the compliance can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Compliance  $model
     * @return mixed
     */
    public function restore(User $user, Compliance $model)
    {
        return false;
    }

    /**
     * Determine whether the compliance can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Compliance  $model
     * @return mixed
     */
    public function forceDelete(User $user, Compliance $model)
    {
        return false;
    }
}
