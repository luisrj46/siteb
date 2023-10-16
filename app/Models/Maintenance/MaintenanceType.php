<?php

namespace App\Models\Maintenance;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model
{
    use HasFactory, ModelTrait;

    const PREVENTIVE = 1;
    const CORRECTIVE = 2;
}
