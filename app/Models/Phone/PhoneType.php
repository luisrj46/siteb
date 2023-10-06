<?php

namespace App\Models\Phone;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneType extends Model
{
    use HasFactory, ModelTrait;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
