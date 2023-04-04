<?php

declare(strict_types=1);

namespace App\Http\Requests\Authenticated;

use Illuminate\Foundation\Http\FormRequest;

class StorePathRequest extends FormRequest {
    public function rules(): array {
        return [
            'path' => [
                'required',
                'string'
            ],
            'user_id' => [
                'required',
                'numeric',
                'exists:users,id'
            ]
        ];
    }
}
