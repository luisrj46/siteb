<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Phone\PhoneType;
use App\Models\User\TypeDocument;
use App\Models\User\TypeUser;
use Illuminate\Http\Request;

class GetUserController extends Controller
{

    public function __construct(Request $request)
    {
        // if (!$request->ajax()) abort(404);
    }

    public function typeDocument(Request $request)
    {
        return response()->json(['results' => TypeDocument::getSearch($request->term)->get()]);
    }

    public function typeUser(Request $request)
    {
        return response()->json(['results' => TypeUser::getSearch($request->term)->get()]);
    }

    public function typePhone(Request $request)
    {
        return response()->json(PhoneType::getSearch($request->term)->get());
    }
   
}
