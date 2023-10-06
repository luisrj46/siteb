<?php

namespace App\Models\User;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    use HasFactory, ModelTrait;

    const CUSTOMER = 1;
    const OWNER = 2;
    const ADMIN = 3;


    public function scopeSlug(Builder $query, string $slug): void
    {
        $query->whereSlug($slug);
    }
}
