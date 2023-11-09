<?php

namespace App\Http\Services\BiomedicalEquipment;

use App\Http\Services\BiomedicalEquipment\Src\SaveBiomedicalEquipment;
use App\Http\Services\Contracts\ServiceInterface;
use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Traits\Services\ServiceTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class BiomedicalEquipmentService implements ServiceInterface
{
    use ServiceTrait;

    public function __construct(private SaveBiomedicalEquipment $saveBiomedicalEquipment)
    {
    }

    public function index(Request $request): object
    {
        $request = $this->pagination($request);

        $biomedicalEquipments = BiomedicalEquipment::search($request)
            ->order($request)
            ->paginate($request->length ?? 10);

        $biomedicalEquipments->append(['actions_access','is_enable_access']);
        
        return $biomedicalEquipments;
    }

    public function form(Request $request, $biomedicalEquipment = new BiomedicalEquipment()): array
    {
        if ($request->action != 'create' && is_null($biomedicalEquipment->id)) abort(404, 'Error al enviar al modelo');
        return [
            'title' => $this->getTitleModal($request),
            'body' => BiomedicalEquipment::form($biomedicalEquipment, $request),
            'footer' => BiomedicalEquipment::footer($biomedicalEquipment, $request),
        ];
    }

    public function store(Request $request): void
    {
        $biomedicalEquipment = new BiomedicalEquipment();
        $this->saveBiomedicalEquipment->save($request, $biomedicalEquipment);
    }

    public function show(Model $biomedicalEquipment): Model
    {
        return $biomedicalEquipment;
    }

    public function update(Request $request, Model $biomedicalEquipment): void
    {
        $this->saveBiomedicalEquipment->save($request, $biomedicalEquipment);
    }

    public function destroy(Model $biomedicalEquipment): void
    {
        $biomedicalEquipment->delete();
    }
}
