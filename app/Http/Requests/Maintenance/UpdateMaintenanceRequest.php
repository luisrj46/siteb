<?php

namespace App\Http\Requests\Maintenance;

use App\Models\Maintenance\MaintenanceType;
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
        $maintenance = $this->maintenance;

        $rules = [
            'maintenance_type_id' => 'required_with:schedule_date|exists:maintenance_types,id',
            'biomedical_equipment_id' => 'required_with:schedule_date|exists:biomedical_equipments,id',
            'user_id' => 'required_with:schedule_date|exists:users,id',
            'scheduled_date' => 'filled|date|date_format:Y-m-d H:i:s',
            'created_by' => 'prohibited'
        ];
        if(boolval($maintenance->maintenanceExecution?->id) || $this->action == 'execution'){
            $rules['execution_start_date'] = 'required|date|date_format:Y-m-d H:i:s';
            $rules['execution_end_date'] = 'required|date|after:execution_start_date|date_format:Y-m-d H:i:s';
            $rules['execution_materials'] = 'required';
            $rules['execution_observation'] = 'required';
            $rules['execution_boss_signature'] = $maintenance?->maintenanceExecution?->boss_signature ? 'nullable|image' : 'required|image';
            $rules['execution_user_id'] = 'prohibited';

            if($this->maintenance?->maintenanceType?->slug == MaintenanceType::PREVENTIVE) {
                $rules['items'] = 'required|array';
                $rules['items.*'] = 'required|integer';
            }
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'maintenance_type_id' => 'tipo',
            'biomedical_equipment_id' => 'equipo biomédico',
            'user_id' => 'responsable',
            'scheduled_date' => 'fecha programada',
            'created_by' => 'registrado por',
            'execution_start_date' => 'fecha inicio',
            'execution_end_date' => 'fecha fin',
            'execution_materials' => 'materials',
            'execution_observation' => 'observaciones',
            'execution_boss_signature' => 'firma jefe',
            'execution_user_id' => 'Ejecutado por',
            'items.*' => 'items'
        ];
    }
}
