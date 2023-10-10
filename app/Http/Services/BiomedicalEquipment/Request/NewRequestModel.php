<?php

namespace App\Http\Services\BiomedicalEquipment\Request;

use App\Traits\Request\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NewRequestModel
{

    use UploadFile;

    public function newRequest(Request $request): array
    {
        $photo = $this->uploadFile($request, 'photo', 'biomedical_equipment/photo');

        $newRequest = $request->all();
        Arr::forget($newRequest, ['photo']);

        $photo ? Arr::set($newRequest, 'photo', $photo) : null;

        return $newRequest;
    }
}
