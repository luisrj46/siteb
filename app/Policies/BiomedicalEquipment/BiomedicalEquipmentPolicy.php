<?php

namespace App\Policies\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class BiomedicalEquipmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        if ($user->can('biomedical.equipment.index')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BiomedicalEquipment $biomedicalEquipment): Response
    {
        if ($user->can('biomedical.equipment.show') || $this->store($user) || $this->update($user, $biomedicalEquipment)) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can create models.
     */
    public function store(User $user): Response
    {
        if ($user->can('biomedical.equipment.store')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BiomedicalEquipment $biomedicalEquipment): Response
    {
        if ($user->can('biomedical.equipment.update')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BiomedicalEquipment $biomedicalEquipment): Response
    {
        if ($user->can('biomedical.equipment.destroy')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function disable(User $user, BiomedicalEquipment $biomedicalEquipment): Response
    {
        if ($user->can('biomedical.equipment.disable')) return Response::allow();

        return Response::deny();
    }
}
