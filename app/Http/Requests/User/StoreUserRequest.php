<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|unique:users,email',
            'phone' => 'required|integer',
            'address' => 'required',
            'roles' => 'required',
            "password" => "required_if:generate_automatically,0|same:password_confirmed|prohibited_if:generate_automatically,1",
            "password_confirmed" => "same:password|prohibited_if:generate_automatically,1",
            "generate_automatically" => "required_if:password,null|boolean",
            'photo' => 'nullable|image',
            'signature' => 'nullable|image',

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
        ];
    }
}
