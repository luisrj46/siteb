<?php

namespace App\Http\Requests\BiomedicalEquipment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBiomedicalEquipmentRequest extends FormRequest
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
            'active_code' => 'required',
            'service_id' => 'required',
            'plan_id' => 'required',
            'operation_manual' => 'required',
            'maintenance_manual' => 'required',
            'items' => 'nullable|array',
            'items.*.description' => 'required',
            'components' => 'nullable|array',
            'components.*.name' => 'required',
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
            'items.*.description' => 'items',
            'components.*.name' => 'nombre del componente',
            'operation_manual' => 'manual de operación',
            'maintenance_manual' => 'manual de mantenimiento',
            'use_biomedical_id' => 'usos',
            'photo' => 'foto',
            'service_id' => 'servicio'
        ];
    }
}
