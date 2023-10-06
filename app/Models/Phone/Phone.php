<?php

namespace App\Models\Phone;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Phone extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'phone_type_id'
    ];

    public function phonable():MorphTo
    {
        return $this->morphTo();
    }

    public function type()
    {
        return $this->belongsTo(PhoneType::class, 'phone_type_id');
    }
}
