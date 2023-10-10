<?php

namespace App\Models\BiomedicalEquipment;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskClass extends Model
{
    use HasFactory, ModelTrait;

    const I = 1;
    const IIA = 2;
    const IIB = 3;
    const III = 4;
}
