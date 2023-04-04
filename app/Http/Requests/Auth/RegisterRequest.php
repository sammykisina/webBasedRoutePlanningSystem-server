<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
            ]
        ];
    }

    public function getNewUserData(): array {
        $data = $this->validated();
        $role = Role::query()->where('slug', 'user')->first();

        $data['password']  = Hash::make(value: $data['password']);
        $data['role_id'] = $role->id;

        return $data;
    }
}
