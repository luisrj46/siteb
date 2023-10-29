<?php

namespace App\Http\Resources\Maintenance;

use App\Models\Maintenance\MaintenanceType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  $this->collection->map(
                function ($item, $key) {
                    return [
                        'id' => $item->id,
                        'title' => $item?->biomedicalEquipment?->name.' - '.$item?->biomedicalEquipment?->active_code,
                        'color' => $item?->maintenanceType?->slug == MaintenanceType::PREVENTIVE ? '#3E97FF' : '#f1416c',
                        'start' => date_create($item->scheduled_date)?->format('c')
                    ];
                }
            )->toArray();
    }
}
