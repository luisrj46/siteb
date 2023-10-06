<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\UpdateProfileRequest;
use App\Http\Services\User\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct(private ProfileService $profileService)
    {
    }

    public function edit(Request $request)
    {
        return $this->profileService->form($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        $this->profileService->update($request);
        return response()->json(["message" => 'Perfil actualizado correctamente']);
    }
}
