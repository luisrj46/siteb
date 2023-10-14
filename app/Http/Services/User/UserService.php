<?php

namespace App\Http\Services\User;

use App\Http\Services\Contracts\ServiceInterface;
use App\Http\Services\User\Src\SaveUser;
use App\Models\User\User;
use App\Traits\Services\ServiceTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class UserService implements ServiceInterface
{
    use ServiceTrait;

    public function __construct(private SaveUser $saveUser)
    {
    }

    public function index(Request $request): object
    {
        $request = $this->pagination($request);

        $users = User::search($request)
            ->order($request)
            ->paginate($request->length ?? 10);

        $users->append(['is_enable_access', 'actions_access']);
        return $users;
    }

    public function form(Request $request, Model $user): array
    {
        if ($request->action != 'create' && is_null($user->id)) abort(404, 'Error al enviar al modelo');
        return [
            'title' => $this->getTitleModal($request),
            'body' => User::form($user, $request),
            'footer' => User::footer($user, $request),
        ];
    }

    public function store(Request $request): void
    {
        $user = new User();
        $this->saveUser->save($request, $user);
    }

    public function show(Model $user): Model
    {
        return $user;
    }

    public function update(Request $request, Model $user): void
    {
        $this->saveUser->save($request, $user);
    }

    public function destroy(Model $user): void
    {
        $user->delete();
    }
}
