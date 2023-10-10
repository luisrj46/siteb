<?php

namespace App\Models\BiomedicalEquipment;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAcquisition extends Model
{
    use HasFactory, ModelTrait;

const PURCHASED = 1;
const CREDIT = 2;
}
