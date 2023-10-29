<?php

namespace App\Http\Services\Maintenance;

use App\Http\Resources\Maintenance\EventsResource;
use App\Http\Services\Maintenance\Src\SaveMaintenance;
use App\Http\Services\Contracts\ServiceInterface;
use App\Models\Maintenance\Maintenance;
use App\Traits\Services\ServiceTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class MaintenanceService implements ServiceInterface
{
    use ServiceTrait;

    public function __construct(private SaveMaintenance $saveMaintenance)
    {
    }

    public function index(Request $request): object
    {
        $request = $this->pagination($request);

        $results = Maintenance::search($request)
            ->order($request)
            ->paginate($request->length ?? 10);

        $results->append(['actions_access', 'type', 'equipment', 'responsible']);

        return $results;
    }

    public function form(Request $request, $maintenance = new Maintenance()): array
    {
        if ($request->action != 'create' && is_null($maintenance->id)) abort(404, 'Error al enviar al modelo');
        return [
            'title' => $this->getTitleModal($request),
            'body' => Maintenance::form($maintenance, $request),
            'footer' => Maintenance::footer($maintenance, $request),
        ];
    }

    public function store(Request $request): void
    {
        $maintenance = new Maintenance();
        $this->saveMaintenance->save($request, $maintenance);
    }

    public function show(Model $maintenance): Model
    {
        return $maintenance;
    }

    public function update(Request $request, Model $maintenance): void
    {
        $this->saveMaintenance->save($request, $maintenance);
    }

    public function getEvents()
    {
        $maintenances = Maintenance::doesntHave('maintenanceExecution')->whereDate('scheduled_date','>=', request()->start)->whereDate('scheduled_date','<', request()->end)->get();
        return new EventsResource($maintenances);
    }

    public function destroy(Model $maintenance): void
    {
        $maintenance->delete();
    }
}
