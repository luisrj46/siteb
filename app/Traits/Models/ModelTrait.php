<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ModelTrait
{

    public function scopeSearch(Builder $query, Request $request): void
    {
        $search = $request->search['value'] ?? null;
        $idd = $request->idd;
        
        if ($search && $search != $idd) {
            foreach (self::searchable ?? [] as $key => $field) {
                $key == 0 ? $query->where($field, 'like', "%$search%") : $query->orWhere($field, 'like', "%$search%");
            }
            if (method_exists(self::class, 'AuxSearch')) {
                $this->AuxSearch($query, $search);
            }
        }
        if($idd > 0 && $search == $idd){
            $query->where('id', $idd);
        }

        $query;
    }

    public function scopeOrder(Builder $query, Request $request): void
    {
        $column = $request->order[0]['column'] ?? 0;
        $order = $request->order[0]['dir'] ?? 'desc';
        $query->orderBy(self::tableFields[$column], $order);
    }

    public function configColumns()
    {
        foreach (self::tableFields ?: [] as $key => $field) {
            $columns[$key]['data'] = $field;
            $columns[$key]['orderable'] = in_array($field, self::searchable);
        }
        return json_encode($columns ?? []);
    }

    public function configColumnDefs()
    {
        $responsivePriorityField = method_exists(self::class, 'responsivePriorityField') ? $this->responsivePriorityField() : [0, -1];

        if (!is_array($responsivePriorityField)) abort(404, 'La configuración de columnDefs deber ser un array');

        foreach ($responsivePriorityField as $key => $target) {
            $columnDefs[$key]['responsivePriority'] = ($key + 1);
            $columnDefs[$key]['targets'] = $target;
        }
        return json_encode($columnDefs ?? []);
    }

    public function scopeGetSearch(Builder $query, $search = ''): void
    {
        if (method_exists(self::class, 'auxGetSearch')) {
            $this->auxGetSearch($query, $search);
            return;
        }

        $query->where('name', 'like', "%$search%")
            ->select(['id', 'name as text']);
    }

    public function scopeEnabled(Builder $query, $is_enabled = 'is_enabled')
    {
        $query->where($is_enabled, 1);
    }

    public function scopeCurrent(Builder $query, $end_date = 'end_date')
    {
        $query->whereDate($end_date, '>=', now());
    }
}
