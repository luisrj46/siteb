<?php

namespace App\Models\User;

use App\Notifications\CustomResetPassword;
use App\Traits\Models\ModelTrait;
use Database\Seeders\Roles\RolesSeeder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, ModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const tableHeaders = ['#', 'Nombre', 'Documento', 'Email', 'Teléfono', 'Rol', 'Activo', 'Acciones'];
    const tableFields = ['id', 'name', 'document', 'email', 'phone', 'role_access', 'is_enable_access', 'actions_access'];
    const searchable = ['id', 'name', 'document', 'email'];

    // Accessor

    protected function photoAccess(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Storage::disk('local')->exists($this->photo ?? '') && filled($this->photo) ? url(Storage::url($this->photo)) : null;
            }
        );
    }

    protected function signatureAccess(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Storage::disk('local')->exists($this->signature ?? '') && filled($this->signature) ? url(Storage::url($this->signature)) : null;
            }
        );
    }

    protected function isEnableAccess(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->is_enabled == 1 ? '<span class="ms-2 badge badge-light-success fw-bold">Si</span>' : '<span class="ms-2 badge badge-light-danger fw-bold">No</span>',
        );
    }

    protected function roleAccess(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->roles->pluck('title')->join(',')
        );
    }

    protected function actionsAccess(): Attribute
    {
        return Attribute::make(
            get: function () {
                return view('admin.user.partials.table._actions', ['record' => $this])->render();
            }
        );
    }


    public static function getRoles()
    {
        return \Spatie\Permission\Models\Role::select('id','title as name')->get();
    }
    //end Accessor

    // form 
    public static function form($record, $request)
    {
        if ($request->action === 'profile') return view('admin.user.partials.modal._profile', ['record' => $record, 'request' => $request])->render();

        if ($request->action === 'delete') return view('admin.user.partials.modal.sub._delete', ['record' => $record])->render();
        return view('admin.user.partials.modal._form', ['record' => $record, 'request' => $request])->render();
    }

    public static function footer($record, $request)
    {
        if ($request->action === 'profile') return view('admin.user.partials.modal._footer_profile', ['record' => $record, 'request' => $request])->render();

        return view('admin.user.partials.modal._footer', ['record' => $record, 'request' => $request])->render();
    }
    // end form

    // scopes

    public function scopeGetSearch(Builder $query, $search = ''): void
    {
        $query->where('name', 'like', "%$search%")
            ->orWhere('document', 'like', "%$search%")
            ->selectRaw("id, CONCAT(name, '-', document) as text");
    }

    //end scopes


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

}
