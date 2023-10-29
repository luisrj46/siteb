<?php

namespace App\Http\Services\Maintenance\Request;

use App\Traits\Request\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class NewRequestModel
{

    use UploadFile;

    public function newRequest(Request $request, bool $isEdit): array
    {
        $signature = $this->uploadOneFile($request->execution_boss_signature, 'axecution/signature_boss');
        
        $newRequest = $request->all();

        Arr::forget($newRequest, ['execution_boss_signature']);

        if (!$isEdit) Arr::set($newRequest, 'created_by', Auth::id());
        if ($signature) Arr::set($newRequest, 'execution_boss_signature', $signature);

        return $newRequest;
    }
}
