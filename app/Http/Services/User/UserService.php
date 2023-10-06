<?php

namespace App\Http\Services\User;

use App\Http\Services\User\Src\SaveUser;
use App\Models\User\User;
use App\Traits\Services\ServiceTrait;
use Illuminate\Http\Request;


class UserService
{
    use ServiceTrait;

    public function __construct(private SaveUser $saveUser)
    {
    }

    public function index(Request $request)
    {
        $request = $this->pagination($request);

        $users = User::search($request)
            ->order($request)
            ->paginate($request->length ?? 10);

        $users->append(['is_enable_access', 'actions_access']);
        return $users;
    }

    public function form(Request $request, $user = new User())
    {
        if ($request->action != 'create' && is_null($user->id)) abort(404, 'Error al enviar al modelo');
        return [
            'title' => $this->getTitleModal($request),
            'body' => User::form($user, $request),
            'footer' => User::footer($user, $request),
        ];
    }

    public function store(Request $request)
    {
        $user = new User();
        $this->saveUser->save($request, $user);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $this->saveUser->save($request, $user);
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
