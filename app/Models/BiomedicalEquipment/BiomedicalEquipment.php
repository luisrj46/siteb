<?php

namespace App\Models\BiomedicalEquipment;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class BiomedicalEquipment extends Model
{
    use HasFactory, ModelTrait;

    protected $table = 'biomedical_equipments';

    protected $guarded = ['id'];

    const tableHeaders = ['#', 'Nombre', 'Marca', 'Modelo', 'Serie', 'Acciones'];
    const tableFields = ['id', 'name', 'brand', 'model', 'series', 'actions_access'];
    const searchable = ['id', 'name', 'brand', 'model'];


    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }

    public function maintenanceItems(): HasMany
    {
        return $this->hasMany(MaintenanceItem::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function formAcquisition(): BelongsTo
    {
        return $this->belongsTo(FormAcquisition::class);
    }

    public function periodicityPreventive(): BelongsTo
    {
        return $this->belongsTo(Period::class, 'periodicity_preventive');
    }

    public function calibrationPeriodicity(): BelongsTo
    {
        return $this->belongsTo(Period::class, 'calibration_periodicity');
    }

    public function requiresCalibration(): BelongsTo
    {
        return $this->belongsTo(YesOrNot::class, 'requires_calibration');
    }

    public function operationManual(): BelongsTo
    {
        return $this->belongsTo(YesOrNot::class, 'operation_manual');
    }

    public function maintenanceManual(): BelongsTo
    {
        return $this->belongsTo(YesOrNot::class, 'maintenance_manual');
    }

    public function damage(): BelongsTo
    {
        return $this->belongsTo(YesOrNot::class, 'damaged');
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function useBiomedical(): BelongsTo
    {
        return $this->belongsTo(UseBiomedical::class);
    }

    public function biomedicalClassification(): BelongsTo
    {
        return $this->belongsTo(BiomedicalClassification::class);
    }

    public function riskClass(): BelongsTo
    {
        return $this->belongsTo(RiskClass::class);
    }

    protected function actionsAccess(): Attribute
    {
        return Attribute::make(
            get: function () {
                return view('admin.biomedical_equipment.partials.table._actions', ['record' => $this])->render();
            }
        );
    }

    protected function photoAccess(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Storage::disk('local')->exists($this->photo ?? '') && filled($this->photo) ? url(Storage::url($this->photo)) : null;
            }
        );
    }

    // form 
    public static function form($record, $request)
    {
        if ($request->action === 'delete') return view('admin.biomedical_equipment.partials.modal.sub._delete', ['record' => $record])->render();
        return view('admin.biomedical_equipment.partials.modal._form', ['record' => $record, 'request' => $request])->render();
    }

    public static function footer($record, $request)
    {
        return view('admin.biomedical_equipment.partials.modal._footer', ['record' => $record, 'request' => $request])->render();
    }
    // end form


    public function syncItems(array $items = [])
    {
        if (count($items) > 0) {
            $old = $this->maintenanceItems->pluck('id')->toArray();
            $new = array_keys($items);
            $forDelete = array_diff($old, $new);
            MaintenanceItem::destroy($forDelete);
            foreach ($items as $item) {
                    $id = $item['id'] > 0 ? $item['id'] : null;
                    $dataItems[] = ['id' => $id, 'description' => $item['description'], 'biomedical_equipment_id' => $this->id];
            }
            if (($dataItems ?? false)) {
                MaintenanceItem::upsert($dataItems, ['id'], ['description']);
            }
        }
    }

    public function syncComponents(Array $components=[])
    {
        if(count($components) > 0){
            $old = $this->components->pluck('id')->toArray();
            $new = Arr::pluck($components, 'id');
            $forDelete = array_diff($old,$new);
            Component::destroy($forDelete);

            foreach ($components as $key => $component) {
                $dataComponents[] = ['id' => $component['id'], 'name' => $component['name'],'brand' => $component['brand'],'model' => $component['model'],'serie' => $component['serie'],'biomedical_equipment_id' => $this->id];
            }
            if(($dataComponents ?? false)){
                Component::upsert($dataComponents,['id'],['name','brand','model','serie']);
            }
        }
    }
}
