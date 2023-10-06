<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

        return [
            'name' => 'required',
            'document' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'phone' => 'required|integer',
            'address' => 'required',
            'roles' => 'required',
            "password" => "same:password_confirmed",
            "password_confirmed" => "same:password",
            'photo' => 'nullable|mimes:jpg,png',
            'signature' => 'nullable|mimes:jpg,png',

        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'document' => 'documento',
            'phone' => 'teléfono',
            'address' => 'dirección',
            'password' => 'contraseña',
            'photo' => 'foto',
            'signature' => 'firma',
            'password_confirmation' => 'confirmar contraseña',
        ];
    }
}
