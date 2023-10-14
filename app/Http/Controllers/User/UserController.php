<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Services\User\UserService;
use App\Models\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('index');
        $users = $this->userService->index($request);
        if ($request->ajax()) {
            return response()->json([
                'recordsTotal'    => $users->total(),
                'recordsFiltered' => $users->total(),
                'data'            => $users->items(),
            ]);
        }
        return view('admin.user.index', ["model" => User::class]);
    }

    public function create(Request $request)
    {
        $this->authorize('store');
        return $this->userService->form($request, new User());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('store');
        $this->userService->store($request);
        return response()->json(["message" => 'Usuario registrado correctamente']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        $this->authorize('view', $user);
        return $this->userService->form($request, $user);
    }

    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);
        return $this->userService->form($request, $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $this->userService->update($request, $user);
        return response()->json(["message" => 'Usuario actualizado correctamente']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $this->userService->destroy($user);
        return response()->json(["message" => 'Usuario eliminado correctamente']);
    }
}
