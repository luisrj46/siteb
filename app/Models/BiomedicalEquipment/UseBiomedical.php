<?php

namespace App\Models\BiomedicalEquipment;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseBiomedical extends Model
{
    use HasFactory, ModelTrait;

    const MEDICAL = 1;
    const BASIC = 2;
    const SUPPORT = 3;
    const TRANSPORT = 4;
}
