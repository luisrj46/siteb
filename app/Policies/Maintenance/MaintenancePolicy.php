<?php

namespace App\Policies\Maintenance;

use App\Models\Maintenance\Maintenance;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class MaintenancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        if ($user->can('maintenance.index')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Maintenance $maintenance): Response
    {
        if ($user->can('maintenance.show') || $this->store($user) || $this->update($user, $maintenance)) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can create models.
     */
    public function store(User $user): Response
    {
        if ($user->can('maintenance.store')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Maintenance $maintenance): Response
    {
        if ($user->can('maintenance.update')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Maintenance $maintenance): Response
    {
        if ($user->can('maintenance.destroy')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function disable(User $user, Maintenance $maintenance): Response
    {
        if ($user->can('maintenance.disable')) return Response::allow();

        return Response::deny();
    }
}
