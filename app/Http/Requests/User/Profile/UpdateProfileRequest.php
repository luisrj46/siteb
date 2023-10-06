<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $user = Auth::user();
        $photo = $user?->photo;
        return [
            "name" => "required",
            "type_document_id" => "required",
            "document" => "required",
            "email" => [
                'email',
                'required',
                Rule::unique('users')->where(fn (Builder $query) => $query->whereNull('deleted_at'))->ignore($user)
            ],
            "country_id" => "required|exists:countries,id",
            "city_id" => "required|exists:cities,id",
            "address" => "nullable|max:200",
            "phones" => "required|array",
            "phones.*.phone_type_id" => "required|exists:phone_types,id",
            "phones.*.number" => "required|integer|digits_between:6,15",
            "password" => "same:password_confirmed",
            "password_confirmed" => "same:password",
            "photo" => $photo ? 'nullable' : 'required' . "|image",
            "presentation" => "required|max:200",
            "is_enabled" => "prohibited",
            "generate_automatically" => "prohibited",
            'type_user_id' => 'prohibited'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function attributes(): array
    {
        return [
            "name" => 'nombre',
            "type_document_id" => 'tipo de documento',
            "document" => 'documento',
            "country_id" => 'pais',
            "city_id" => 'ciudad',
            "address" => 'dirección',
            "phones" => 'telefono',
            "phones.*.phone_type_id" => 'tipo de teléfono',
            "phones.*.number" => 'numero de teléfono',
            "password" => 'contraseña',
            "password_confirmed" => 'confirmar contraseña',
            "generate_automatically" => 'generar contraseña automaticamente',
            "is_enabled" => 'activo',
            "photo" => 'foto',
            "presentation" => 'presentación',
            "type_user" => 'tipo de usuario',
        ];
    }
}
