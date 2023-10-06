<?php

namespace App\Traits\Request;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

trait UploadFile
{

    public function uploadFile(Request $request, String $key, String $pathRoot = 'files', String $keyId = null)
    {

        $files = $request->file($key);
        if (!is_iterable($files) && $files) {
            return $files->store("public/$pathRoot");
        }

        $paths = null;
        foreach ($files ?? [] as $file) {
            if ($file[$keyId]->isValid()) {
                $paths[] = $file[$keyId]->store("public/$pathRoot");
            }
        }

        return $paths;
    }

    public function uploadOneFile(?UploadedFile $file, String $pathRoot = 'files'): string | null
    {
        if(!($file instanceof UploadedFile)) return null;
        return $file->store("public/$pathRoot");
    }
}
