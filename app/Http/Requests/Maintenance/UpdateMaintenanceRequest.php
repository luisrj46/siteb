<?php

namespace App\Http\Requests\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceRequest extends FormRequest
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
            'maintenance_type_id' => 'required|exists:maintenance_types,id',
            'biomedical_equipment_id' => 'required|exists:biomedical_equipments,id',
            'user_id' => 'required|exists:users,id',
            'scheduled_date' => 'required|date|date_format:Y-m-d H:i:s',
            'created_by' => 'prohibited'
        ];
    }

    public function attributes(): array
    {
        return [
            'maintenance_type_id' => 'tipo',
            'biomedical_equipment_id' => 'equipo biomédico',
            'user_id' => 'responsable',
            'scheduled_date' => 'fecha programada',
            'created_by' => 'registrado por',
        ];
    }
}