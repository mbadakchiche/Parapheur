<?php

namespace App\Policies;

use App\Models\Dossier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DossierPolicy
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
        return $user->canViewDossiers();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        //
        return $user->canViewDossiers();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->canCreateDossiers();
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        //
        return $user->canEditDossiers();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->canDeleteDossiers();
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        return $user->canDeleteDossiers();
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Dossier $dossier)
    {
        //
    }
}
