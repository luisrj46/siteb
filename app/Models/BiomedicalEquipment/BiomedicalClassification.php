<?php

namespace App\Models\BiomedicalEquipment;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiomedicalClassification extends Model
{
    use HasFactory, ModelTrait;

    const DIAGNOSTIC = 1;
    const THERAPEUTIC = 2;
    const ANALYTICAL = 3;
    const OTHER = 4;
}
