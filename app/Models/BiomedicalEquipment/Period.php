<?php

namespace App\Models\BiomedicalEquipment;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory, ModelTrait;

    const TRIMESTER = 1;
    const QUARTERLY = 2;
    const BIANNUAL = 3;
    const ANNUAL = 4;
}
