<?php

namespace App\Http\Services\Maintenance\Request;

use App\Traits\Request\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class NewRequestModel
{

    use UploadFile;

    public function newRequest(Request $request, bool $isNew): array
    {

        $newRequest = $request->all();

        if (!$isNew) Arr::set($newRequest, 'created_by', Auth::id());

        return $newRequest;
    }
}
