<?php

namespace App\Http\Services\User;

use App\Http\Services\User\Src\SaveUser;
use App\Models\User\User;
use App\Traits\Services\ServiceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    use ServiceTrait;

    private $user;

    public function __construct(private SaveUser $saveUser, private Request $request)
    {
        
    }

    public function form(Request $request)
    {
        $this->user = $request->user();
        return [
            'title' => 'Mi perfil',
            'body' => User::form($this->user, $request, $this->user->type_user_id),
            'footer' => User::footer($this->user, $request, $this->user->type_user_id),
        ];
    }

    public function update(Request $request)
    {
        $this->user = $request->user();
        $this->saveUser->save($request, $this->user, $this->user->type_user_id);
    }
}
