<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory, ModelTrait, SoftDeletes;
    
    protected $guarded = ['id'];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'fileable_id'
    ];

    public function fileable():MorphTo
    {
        return $this->morphTo();
    }

    public function scopeField(Builder $query, String $field): void
    {
        $query->where('field', $field);
    }

    protected function urlAccess(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Storage::disk('local')->exists($this->path ?? '') && filled($this->path) ? url(Storage::url($this->path)) : null;
            }
        );
    }
}
