<?php

namespace App\Models\Maintenance;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class MaintenanceExecution extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function signatureBossAccess(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Storage::disk('local')->exists($this->boss_signature ?? '') && filled($this->boss_signature) ? url(Storage::url($this->boss_signature)) : null;
            }
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
