<?php

namespace App\Policies;

use App\Models\Models\circulation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class circulationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return  $user->canViewCirculations();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Models\circulation  $circulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, circulation $circulation)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function record(User $user)
    {
        return  $user->canRecordCirculations();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Models\circulation  $circulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function send(User $user)
    {
        return  $user->canSendCirculations();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Models\circulation  $circulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function process(User $user)
    {
        return  $user->canProcessCirculations();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Models\circulation  $circulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function dispatch(User $user)
    {
        return  $user->canDispatchCirculations();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Models\circulation  $circulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, circulation $circulation)
    {
        //
    }
}
