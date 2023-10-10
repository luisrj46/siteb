<?php

namespace App\Http\Controllers\BiomedicalEquipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\BiomedicalEquipment\StoreBiomedicalEquipmentRequest;
use App\Http\Requests\BiomedicalEquipment\UpdateBiomedicalEquipmentRequest;
use App\Http\Services\BiomedicalEquipment\BiomedicalEquipmentService;
use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use Illuminate\Http\Request;

class BiomedicalEquipmentController extends Controller
{
    public function __construct(private BiomedicalEquipmentService $biomedicalEquipmentService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('index');
        $biomedicalEquipments = $this->biomedicalEquipmentService->index($request);
        if ($request->ajax()) {
            return response()->json([
                'recordsTotal'    => $biomedicalEquipments->total(),
                'recordsFiltered' => $biomedicalEquipments->total(),
                'data'            => $biomedicalEquipments->items(),
            ]);
        }
        return view('admin.biomedical_equipment.index', ["model" => BiomedicalEquipment::class]);
    }

    public function create(Request $request)
    {
        $this->authorize('store');
        return $this->biomedicalEquipmentService->form($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBiomedicalEquipmentRequest $request)
    {
        $this->authorize('store');
        $this->biomedicalEquipmentService->store($request);
        return response()->json(["message" => 'Equipo biomédico registrado correctamente']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, BiomedicalEquipment $biomedicalEquipment)
    {
        $this->authorize('view', $biomedicalEquipment);
        return $this->biomedicalEquipmentService->form($request, $biomedicalEquipment);
    }

    public function edit(Request $request, BiomedicalEquipment $biomedicalEquipment)
    {
        $this->authorize('update', $biomedicalEquipment);
        return $this->biomedicalEquipmentService->form($request, $biomedicalEquipment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBiomedicalEquipmentRequest $request, BiomedicalEquipment $biomedicalEquipment)
    {
        $this->authorize('update', $biomedicalEquipment);
        $this->biomedicalEquipmentService->update($request, $biomedicalEquipment);
        return response()->json(["message" => 'Equipo biomédico actualizado correctamente']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BiomedicalEquipment $biomedicalEquipment)
    {
        $this->authorize('delete', $biomedicalEquipment);
        $this->biomedicalEquipmentService->destroy($biomedicalEquipment);
        return response()->json(["message" => 'Equipo biomédico eliminado correctamente']);
    }
}
