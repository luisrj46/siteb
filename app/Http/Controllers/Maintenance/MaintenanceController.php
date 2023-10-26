<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\StoreMaintenanceRequest;
use App\Http\Requests\Maintenance\UpdateMaintenanceRequest;
use App\Http\Services\Maintenance\MaintenanceService;
use App\Models\Maintenance\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function __construct(private MaintenanceService $maintenanceService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Maintenance::class);
        $maintenances = $this->maintenanceService->index($request);
        if ($request->ajax()) {
            return response()->json([
                'recordsTotal'    => $maintenances->total(),
                'recordsFiltered' => $maintenances->total(),
                'data'            => $maintenances->items(),
            ]);
        }
        return view('admin.maintenance.index', ["model" => Maintenance::class]);
    }

    public function create(Request $request)
    {
        $this->authorize('store', Maintenance::class);
        return $this->maintenanceService->form($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaintenanceRequest $request)
    {
        $this->authorize('store', Maintenance::class);
        $this->maintenanceService->store($request);
        return response()->json(["message" => 'Mantenimiento registrado correctamente']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, Maintenance $maintenance)
    {
        $this->authorize('view', $maintenance);
        return $this->maintenanceService->form($request, $maintenance);
    }

    public function edit(Request $request, Maintenance $maintenance)
    {
        $this->authorize('update', $maintenance);
        return $this->maintenanceService->form($request, $maintenance);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance)
    {
        $this->authorize('update', $maintenance);
        $this->maintenanceService->update($request, $maintenance);
        return response()->json(["message" => 'Mantenimiento actualizado correctamente']);
    }


    public function execution(Request $request, Maintenance $maintenance)
    {
        $this->authorize('execution', $maintenance);
        return $this->maintenanceService->form($request, $maintenance);
    }

    public function executionSave(UpdateMaintenanceRequest $request, Maintenance $maintenance)
    {
        $this->authorize('execution', $maintenance);
        $this->maintenanceService->update($request, $maintenance);
        return response()->json(["message" => 'Mantenimiento ejecutado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $this->authorize('delete', $maintenance);
        $this->maintenanceService->destroy($maintenance);
        return response()->json(["message" => 'Mantenimiento eliminado correctamente']);
    }
}
