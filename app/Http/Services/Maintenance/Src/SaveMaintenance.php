<?php

namespace App\Http\Services\Maintenance\Src;

use App\Exceptions\ErrorDatabaseException;
use App\Http\Services\Maintenance\Request\NewRequestModel;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SaveMaintenance
{


    public function save(Request $request, Model $model): Model
    {
        $newRequestModel = new NewRequestModel();
        try {
            DB::beginTransaction();

            $newRequest = $newRequestModel->newRequest($request, $model->id);

            $model->fill($newRequest);

            $model->save();
            // $model->syncItems($request->items);
            // $model->syncComponents($request->components);

            DB::commit();
        } catch (Exception $exc) {
            DB::rollback();
            throw new ErrorDatabaseException(412, __('Error en la operación de base de datos'), $exc);
        }

        return $model;
    }
}