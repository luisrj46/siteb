<?php

namespace App\Models\Maintenance;

use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\User\User;
use App\Traits\Models\ModelTrait;
use Database\Seeders\Roles\RolesSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Maintenance extends Model
{
    use HasFactory, ModelTrait, SoftDeletes;

    protected $guarded = ['id'];

    const tableHeaders = ['#', 'Tipo', 'Equipo', 'Responsable', 'Fecha programada', 'Acciones'];
    const tableFields = ['id', 'type', 'equipment', 'responsible', 'scheduled_date', 'actions_access'];
    const searchable = ['id', 'scheduled_date'];

    protected $casts = [
        'scheduled_date' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('own', function (Builder $builder) {
            $user = Auth::user();
            $ids = explode(',',request('idd'));
            $searchIdd = is_null(request('search')) ? [] : explode(',',request('search')['value']);
            if ($user?->id) {
                if ($user->hasExactRoles(RolesSeeder::SUPPORT)) {
                    if(request('action') != 'view'){
                        $builder->where('user_id', Auth::id()); //->has('maintenanceExecution');
                    }
                    if(!is_null(request('idd')) && $ids == $searchIdd){
                        $builder->orWhereIn('id', $ids);
                    }
                }
            }
        });
    }


    public function maintenanceExecution(): HasOne
    {
        return $this->hasOne(MaintenanceExecution::class);
    }

    public function maintenanceType(): BelongsTo
    {
        return $this->belongsTo(MaintenanceType::class);
    }

    public function biomedicalEquipment(): BelongsTo
    {
        return $this->belongsTo(BiomedicalEquipment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected function type(): Attribute
    {
        $class = $this->maintenanceType->slug == MaintenanceType::CORRECTIVE ? 'danger' : 'primary';
        $icon = $this->maintenanceExecution?->id ? '<i title="Ejecutado" class="bi cursor-pointer bi-check-square-fill text-success"></i>' : '<i title="Pendiente" class="bi cursor-pointer bi-clock text-primary"></i>';
        return Attribute::make(
            get: fn () => '<span class="ms-2 mx-2 badge badge-light-' . $class . ' fw-bold">' . $this->maintenanceType->name . '</span>' . $icon
        );
    }

    protected function equipment(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->biomedicalEquipment->name . ' - ' . $this->biomedicalEquipment->id
        );
    }

    protected function responsible(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user->name . ' - ' . $this->user->document
        );
    }

    // form 
    protected function actionsAccess(): Attribute
    {
        return Attribute::make(
            get: function () {
                return view('admin.maintenance.partials.table._actions', ['record' => $this])->render();
            }
        );
    }

    public static function form($record, $request)
    {
        if ($request->action === 'delete') return view('admin.maintenance.partials.modal.sub._delete', ['record' => $record])->render();
        return view('admin.maintenance.partials.modal._form', ['record' => $record, 'request' => $request])->render();
    }

    public static function footer($record, $request)
    {
        return view('admin.maintenance.partials.modal._footer', ['record' => $record, 'request' => $request])->render();
    }
    // end form

    private function AuxSearch(Builder $query, $search = ''): void
    {
        $query->orWhereHas('maintenanceType', function (Builder $query) use ($search) {
            $query->where('name', 'like', "%$search%");
        });

        $query->orWhereHas('biomedicalEquipment', function (Builder $query) use ($search) {
            $query->where('name', 'like', "%$search%");
        });

        $query->orWhereHas('user', function (Builder $query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('document', 'like', "%$search%");
        });
    }

    function syncExecution(array $request): void
    {
        $request = (object) $request;
        if (isset($request->execution_start_date)) {
            $fieldUpdate = [
                'maintenance_id' => $this->id,
                'start_date' => $request->execution_start_date,
                'end_date' => $request->execution_end_date,
                'materials' => $request->execution_materials,
                'observation' => $request->execution_observation,
            ];

            if (isset($request->execution_boss_signature)) $fieldUpdate['boss_signature'] = $request->execution_boss_signature;
            if (is_null($this->maintenanceExecution)) $fieldUpdate['user_id'] = Auth::id();

            $maintenanceExecution = $this->maintenanceExecution()->updateOrCreate(
                [
                    'id' => $request->execution_id,
                ],
                $fieldUpdate
            );

            $maintenanceExecution->syncDetailExecution($request->items ?? []);
        }
    }
}
