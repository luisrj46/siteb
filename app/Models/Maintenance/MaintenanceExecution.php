<?php

namespace App\Models\Maintenance;

use App\Models\BiomedicalEquipment\MaintenanceItem;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class MaintenanceExecution extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function signatureBossAccess(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Storage::disk('local')->exists($this->boss_signature ?? '') && filled($this->boss_signature) ? url(Storage::url($this->boss_signature)) : null;
            }
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function maintenance(): BelongsTo
    {
        return $this->belongsTo(Maintenance::class);
    }

    public function detailExecutions(): HasMany
    {
        return $this->hasMany(DetailExecution::class);
    }

    function syncDetailExecution(?array $items = []): void
    {
        if (count($items)) {
            $this->detailExecutions()->delete();
            foreach ($items as $key => $value) {
                $this->detailExecutions()->create([
                    'maintenance_item_id' => $key,
                    'yes_or_not_id' => $value,
                ]);
            }
        }
    }
}
