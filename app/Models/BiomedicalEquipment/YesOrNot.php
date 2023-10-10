<?php

namespace App\Models\BiomedicalEquipment;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YesOrNot extends Model
{
    use HasFactory, ModelTrait;

    const YES = 1;
    const NOT = 2;
}
