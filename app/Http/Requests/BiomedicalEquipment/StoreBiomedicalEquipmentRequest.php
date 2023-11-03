<?php

namespace App\Http\Requests\BiomedicalEquipment;

use Illuminate\Foundation\Http\FormRequest;

class StoreBiomedicalEquipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'series' => 'required',
            'requires_calibration' => 'required',
            'plan_id' => 'required',
            'use_biomedical_id' => 'required',
            'operation_manual' => 'required',
            'maintenance_manual' => 'required',
            'items' => 'nullable|array',
            'items.*' => 'required',
            'components' => 'nullable|array',
            'component.name.*' => 'required',
            'photo' => 'nullable|image',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'brand' => 'marca',
            'model' => 'modelo',
            'series' => 'serie',
            'requires_calibration' => 'requiere calibración',
            'plan_id' => 'planos',
            'items.*' => 'items',
            'component.name.*' => 'nombre del componente',
            'operation_manual' => 'manual de operación',
            'maintenance_manual' => 'manual de mantenimiento',
            'use_biomedical_id' => 'usos',
            'photo' => 'foto',
        ];
    }
}
