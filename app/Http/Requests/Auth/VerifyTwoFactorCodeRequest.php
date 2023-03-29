<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyTwoFactorCodeRequest extends FormRequest {
    public function rules(): array {
        return [
            'twoFactorCode' => [
                'required',
                'size:6',
                'exists:users,twoFactorCode'
            ],
            'forgotPassword' => [
                'required',
                'boolean'
            ]
        ];
    }
}
