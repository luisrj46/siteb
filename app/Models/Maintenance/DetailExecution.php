<?php

namespace App\Models\Maintenance;

use App\Models\BiomedicalEquipment\MaintenanceItem;
use App\Models\BiomedicalEquipment\YesOrNot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailExecution extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function maintenanceItem(): BelongsTo
    {
        return $this->belongsTo(MaintenanceItem::class);
    }

    public function yesOrNot(): BelongsTo
    {
        return $this->belongsTo(YesOrNot::class);
    }
}
