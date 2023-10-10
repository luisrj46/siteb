<?php

namespace App\Models\BiomedicalEquipment;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory, ModelTrait;

    const MECHANICS = 1;
    const ELECTRONICS = 2;
    const HYDRAULIC = 3;
    const TIRES = 4;
}
