<?php

namespace App\Http\Requests;

use App\Enums\UserTypes;
use App\Http\Requests\Api\JsonRequest;

class LoginRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'entity'   => 'required|in:' . implode(',', UserTypes::getAllValues()),
        ];
    }
}
