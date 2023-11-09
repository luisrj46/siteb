<?php

namespace App\Http\Services\Home;

use App\Http\Services\Contracts\IndexInterface;
use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\Maintenance\Maintenance;
use App\Models\Maintenance\MaintenanceType;
use App\Models\User\User;
use Illuminate\Http\Request;


class HomeService implements IndexInterface
{
    public function index(): object
    {
        $biomedicalEquipments = BiomedicalEquipment::all();
        $maintenances = Maintenance::all();
        $execution = Maintenance::has('maintenanceExecution')->get();
        $user = User::all();
        $result = (object)[
            'equipment' => (object)[
                'total' => $biomedicalEquipments->count(),
                'enabled' => $biomedicalEquipments->where('is_enabled', 1)->count(),
                'disabled' => $biomedicalEquipments->where('is_enabled', 0)->count(),
            ],
            'maintenance' => (object)[
                'total' => $maintenances->count(),
                'preventive' => $maintenances->where('maintenance_type_id', MaintenanceType::PREVENTIVE)->count(),
                'corrective' => $maintenances->where('maintenance_type_id', MaintenanceType::CORRECTIVE)->count(),
            ],
            'execution' => (object)[
                'total' => $execution->count(),
                'preventive' => $execution->where('maintenance_type_id', MaintenanceType::PREVENTIVE)->count(),
                'corrective' => $execution->where('maintenance_type_id', MaintenanceType::CORRECTIVE)->count(),
            ],
            'user' => (object)[
                'total' => $user->count(),
                'enabled' => $user->where('is_enabled', 1)->count(),
                'disabled' => $user->where('is_enabled', 0)->count(),
            ]
        ];
        return $result;
    }
}
