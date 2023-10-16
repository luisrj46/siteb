<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\Maintenance\MaintenanceType;
use App\Models\User\User;
use Database\Seeders\Roles\RolesSeeder;
use Illuminate\Http\Request;

class GetMaintenanceController extends Controller
{
    

    public function typeMaintenance(Request $request)
    {
        return response()->json([
            'results' => MaintenanceType::getSearch($request->term)->get()
        ]);
    }

    public function biomedicalEquipment(Request $request)
    {
        return response()->json([
            'results' => BiomedicalEquipment::getSearch($request->term)->get()
        ]);
    }

    public function responsible(Request $request)
    {
        return response()->json([
            'results' => User::role(RolesSeeder::SUPPORT)->getSearch($request->term)->get()
        ]);
    }

    public function user(Request $request)
    {
        return response()->json([
            'results' => User::getSearch($request->term)->get()
        ]);
    }

}
