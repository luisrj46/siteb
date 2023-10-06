<?php

namespace App\Models\User;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    use HasFactory, ModelTrait;

    protected $hidden = [
        'slug',
        'created_at',
        'updated_at',
    ];
}
