<?php

namespace App\Http\Services\User\Src;

use App\Events\RegisteredUserEvent;
use App\Exceptions\ErrorDatabaseException;
use App\Http\Services\User\Request\NewRequestUser;
use App\Models\User\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SaveUser
{

    public function __construct(public $userId = 0)
    {
    }

    public function save(Request $request, User $user): User
    {
        $this->userId = $user->id;
        $newRequestUser = new NewRequestUser();
        try {
            DB::beginTransaction();

            $newRequest = $newRequestUser->newRequest($request, $this->isNew());

            $user->fill($newRequest);

            $user->save();

            $user->roles()->sync([$request->roles]);

            $this->sendEvent($user, $newRequest["password"] ?? '');

            DB::commit();
        } catch (Exception $exc) {
            DB::rollback();
            throw new ErrorDatabaseException(412, __('Error en la operación de base de datos'), $exc);
        }

        return $user;
    }


    private function sendEvent(User $user, String $password)
    {
        if ($this->isNew()) {
            event(new RegisteredUserEvent($user, $password));
        }
    }

    private function isNew(): bool
    {
        return $this->userId > 0 ? false : true;
    }
}
