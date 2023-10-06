<?php

namespace App\Http\Services\User\Request;

use App\Models\User\TypeUser;
use App\Traits\Request\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class NewRequestUser
{

    use UploadFile;

    public function newRequest(Request $request, bool $isNew): array
    {
        $photo = $this->uploadFile($request, 'photo', 'users/photo');
        $signature = $this->uploadFile($request, 'signature', 'users/signature');

        $password = ((empty($request->password) && $request->generate_automatically == 1) && $isNew) ? Str::random(15) : $request->password;

        $newRequest = $request->all();
        Arr::forget($newRequest, ['photo', 'password', 'password_confirmation']);

        $photo ? Arr::set($newRequest, 'photo', $photo) : null;
        $signature ? Arr::set($newRequest, 'signature', $signature) : null;
        $password ? Arr::set($newRequest, 'password', $password) : null;

        return $newRequest;
    }
}
