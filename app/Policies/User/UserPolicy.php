<?php

namespace App\Policies\User;

use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        if ($user->can('user.index')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        if ($user->can('user.show') || $this->store($user) || $this->update($user,$model) ) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can create models.
     */
    public function store(User $user): Response
    {
        if ($user->can('user.store')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        if ($user->can('user.update')) return Response::allow();

        return Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        if ($user->can('user.destroy')) return Response::allow();

        return Response::deny();
    }

}
