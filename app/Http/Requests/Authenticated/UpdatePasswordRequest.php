<?php

declare(strict_types=1);

namespace App\Http\Requests\Authenticated;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest {
    public function rules(): array {
        return [
            'userId' => [
                'required',
                'numeric',
                'exists:users,id'
            ],
            'password' => [
                'required',
                'string'
            ]
        ];
    }
    public function getUpdatedPasswordData(): array {
        $data = $this->validated();
        $data['password']  = Hash::make(value: $data['password']);
        return $data;
    }
}
