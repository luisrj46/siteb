<?php

namespace App\Traits\Services;

use Illuminate\Http\Request;

trait ServiceTrait
{

    public function pagination(Request $request): Request
    {
        $paginate = ($request->start > 0 ? ($request->start / $request->length) : 0) + 1;
        $request->offsetSet('page', $paginate);
        return $request;
    }

    public function getTitleModal($request)
    {
        $actions = ['create' => 'Crear', 'view' => 'Ver', 'edit' => 'Editar', 'delete' => 'Eliminar', 'execution' => 'Ejecutar'];

        return $actions[$request->action] . ' ' . $request->modelTitle;
    }
}
